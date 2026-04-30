# HandaPH — Backend Development Agreement

**Document type:** Locked-in decisions agreed between developer and project owner
**Date locked:** April 30, 2026
**Branch:** `claude/analyze-handaph-codebase-P6ixN`

This document captures every decision agreed upon during the backend planning conversation. It is the single source of truth for what is being built. Any change to the items below requires a new agreement and an update to this file.

---

## 1. Project Overview

HandaPH is a personalized typhoon preparedness web system for Filipino households. The current state is a fully functional static front-end deployed on Vercel. The backend phase will:

- Migrate the static HTML pages into a single Laravel monolith using Blade templates.
- Replace hardcoded JavaScript rule data with database-driven content managed by an admin.
- Capture anonymous survey submissions and user feedback.
- Provide an admin dashboard with real analytics.
- Deploy as a single full-stack application on Railway.

---

## 2. Locked Tech Stack

| Layer | Technology | Reason |
|---|---|---|
| Framework | Laravel 11 (LTS) | Long-term support through 2026, mature ecosystem |
| Language | PHP 8.3 | Required by Laravel 11 |
| Database | MySQL 8 (Railway-managed) | Native Railway plugin, fixed by project requirements |
| Templating | Blade | Native to Laravel, no extra build step |
| Auth scaffolding | Laravel Breeze (Blade flavor) | Minimal, session-based, no API token complexity |
| Front-end CSS | Bootstrap 5 (existing) | Already wired across all pages |
| Front-end JS | Vanilla JS + Chart.js (existing) | No SPA framework, no Node build pipeline |
| Hosting | Railway | Native MySQL on the same platform |
| Domain | Railway free subdomain (`*.up.railway.app`) | No custom domain in scope |

---

## 3. Architecture Decisions

- **Monolithic application.** Laravel serves both HTML (Blade) and JSON (for Chart.js endpoints).
- **Single deployment.** No separate front-end and back-end services.
- **No SPA, no API tokens, no Sanctum.** Authentication is session-cookie based.
- **Single admin user.** One seeded admin account. Self-registration is disabled.
- **No password reset feature.** Out of scope for v1.

---

## 4. Database Schema (6 tables)

### `users`
Laravel default `users` table. Holds the single admin record only.
- `id`, `name`, `email` (unique), `email_verified_at` (nullable), `password` (bcrypt), `remember_token`, `created_at`, `updated_at`

### `survey_submissions`
Anonymous log of every "Generate Checklist" click. Powers the analytics dashboard.
- `id`
- `location` enum: `coastal | mountainous | inland | flood-prone`
- `household_size` enum: `1 | 2-4 | 5-7 | 8-plus`
- `special_needs` JSON (array; may be empty; values: `children, seniors, pwd, pets`)
- `house_type` enum: `light | semi-concrete | concrete`
- `created_at`
- No PII, no IP, no cookies.

### `checklist_rules`
Replaces the hardcoded `checklistRules` array currently in `assets/js/checklist.js`. Admin-managed.
- `id`
- `item_text` text
- `phase` enum: `before | during | after`
- `tag` string (e.g., "Water", "Food", "Medical", "Safety")
- `tag_class` string (e.g., "tag-water" — preserved for CSS compatibility)
- `locations` JSON (empty array means "applies to all")
- `sizes` JSON (empty means "applies to all")
- `special_needs` JSON (empty means "applies to all")
- `house_types` JSON (empty means "applies to all")
- `is_active` boolean default true
- `created_at`, `updated_at`

### `preparedness_tips`
Admin-managed standalone tips, separate from the rule engine.
- `id`, `logic_id` string unique (e.g., "TIP-102"), `title`, `content` text, `tag` enum (`before | during | after`), `is_active`, timestamps

### `feedbacks`
Public feedback submissions.
- `id`
- `rating` tinyint (1–5)
- `easy_to_understand` enum (`yes_very_easy | somewhat | confusing`) nullable
- `helpful_prepare` enum (`yes_very_helpful | somewhat_helpful | no_not_really`) nullable
- `improve_comments` text nullable
- `region` string nullable (PH region code)
- `created_at`

### `go_bag_items`
Admin-managed Go-Bag content. Static (not tied to checklist input).
- `id`
- `category` enum: `essentials | recommended | optional`
- `name` string
- `description` text nullable
- `budget_alternative` text nullable
- `is_active` boolean default true
- `created_at`, `updated_at`

### Schema notes
- **JSON columns** were chosen over pivot tables for the rule-targeting fields. Tradeoff: faster to ship, slightly less queryable. MySQL 8's `JSON_CONTAINS` covers our filtering needs.
- All timestamps use `timestamp` type and Laravel's default `created_at` / `updated_at` convention.
- All migrations will be reversible (`down()` defined).

---

## 5. Route Map (~17 routes)

### Public (no auth)
| Method | Path | Purpose |
|---|---|---|
| GET | `/` | Home page |
| GET | `/checklist` | Survey form |
| POST | `/checklist/generate` | Logs submission, returns filtered checklist |
| GET | `/go-bag` | Static Go-Bag guide (DB-driven content) |
| GET | `/feedback` | Feedback form |
| POST | `/feedback` | Stores feedback |

### Auth
| Method | Path | Purpose |
|---|---|---|
| GET | `/admin/login` | Login form |
| POST | `/admin/login` | Authenticate (rate-limited 5/min) |
| POST | `/admin/logout` | Logout |

### Admin (protected by `auth` middleware)
| Method | Path | Purpose |
|---|---|---|
| GET | `/admin/dashboard` | Analytics page |
| GET | `/admin/api/analytics` | JSON for Chart.js |
| GET | `/admin/feedback` | Feedback management table |
| GET POST PUT DELETE | `/admin/checklist-rules[/{id}]` | Rules CRUD |
| GET POST PUT DELETE | `/admin/tips[/{id}]` | Tips CRUD |
| GET POST PUT DELETE | `/admin/go-bag-items[/{id}]` | Go-Bag CRUD |
| GET PUT | `/admin/account` | Profile update |

---

## 6. Security Requirements

Every item below is mandatory before deploy.

1. CSRF tokens on all POST/PUT/DELETE forms (`@csrf` Blade directive).
2. Passwords stored with bcrypt via `Hash::make()`.
3. SQL injection protection — Eloquent only, no raw user input in `DB::raw()`.
4. XSS protection — Blade's `{{ }}` auto-escape; `{!! !!}` only for trusted strings.
5. Mass-assignment protection — `$fillable` defined on every model.
6. Login throttle — `throttle:5,1` middleware (5 attempts per minute).
7. Session security — `SESSION_SECURE_COOKIE=true`, `SESSION_HTTP_ONLY=true`, `SESSION_SAME_SITE=lax` in production.
8. Force HTTPS — middleware for production env.
9. Form Request validation classes for every public POST.
10. Rate-limit on public feedback endpoint (`throttle:10,1` to deter spam).
11. Secrets in `.env` only; never committed; injected via Railway dashboard.
12. DB user least-privilege — production user has only `SELECT/INSERT/UPDATE/DELETE`.
13. Daily logs via Laravel's default channel; no logging of request bodies on auth/feedback.
14. Production env: `APP_DEBUG=false`, `APP_ENV=production`.
15. Breeze registration routes deleted; only login + logout remain.
16. `auth` middleware group on all `/admin/*` routes.
17. Analytics endpoint requires session cookie; no public access to raw data.

---

## 7. Code Delivery Protocol

This is how we will work day-to-day:

- I will **never silently write source code files**. Markdown documentation is the only exception.
- For every code change I will send a chat message containing:
  1. **File path** (absolute or relative to project root)
  2. **Action**: `CREATE NEW FILE`, `REPLACE ENTIRE FILE`, or `EDIT — replace lines X–Y`
  3. **Code block** (kept small)
  4. **What it does** (1–2 sentences)
  5. **How to test** before moving on
- You type → save → test → confirm → I send the next block.
- If a block is large, I will break it into segments.

---

## 8. Deployment Plan

**Platform:** Railway
**Database:** Railway-managed MySQL (added as a plugin)
**Domain:** `*.up.railway.app` free subdomain

Deployment steps (executed on Day 12 of the build plan):
1. Push branch to GitHub.
2. Create Railway project → Deploy from GitHub repo.
3. Add MySQL plugin → Railway auto-injects `MYSQLHOST`, `MYSQLPORT`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`.
4. Set env vars in Railway dashboard: `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `SESSION_SECURE_COOKIE=true`.
5. Configure `nixpacks.toml` (or rely on auto-detect) so deploy runs: `composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan db:seed --force && php artisan config:cache`.
6. First deploy → verify HTTPS subdomain → seed admin → smoke-test login + each public form.

---

## 9. Deadline and Targets

| Milestone | Date |
|---|---|
| Backend planning locked | April 30, 2026 |
| Build start (Day 1) | April 30, 2026 |
| **Target completion (core features tested)** | **May 11, 2026** |
| Acceptable completion window | May 11–13, 2026 |
| **Hard deadline** | **May 15, 2026** |

The 2–4 day buffer between target and hard deadline is reserved for QA, bug fixes, and unexpected deployment issues. The buffer is non-negotiable; we do not eat into it for new features.

---

## 10. Out of Scope (explicit non-goals)

These were considered and deliberately excluded:

- Password reset flow (email-based).
- Multi-admin / role-based access control.
- Custom domain.
- PDF generation library (we keep `window.print()` from the existing front-end).
- Dynamic Go-Bag content driven by checklist answers.
- Public user accounts / sign-ups.
- Two-factor authentication.
- Email notifications.
- Internationalization beyond English.
- Front-end build pipeline (Vite, npm, Tailwind, etc.).

---

## 11. Sign-Off

This document is the agreement. By proceeding to Day 1 of the build plan, both parties accept these terms. Changes require written confirmation and an update to this file.
