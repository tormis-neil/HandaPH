# HandaPH — Backend Development Plan

**Companion to:** `handaph-backend-agreement.md`
**Build window:** April 30 – May 13, 2026 (target) / May 15, 2026 (hard deadline)
**Branch:** `claude/analyze-handaph-codebase-P6ixN`

This document is the day-by-day execution guide. Each phase has a deliverable, files touched, and a testing checklist. Update the **Status** column as we go.

---

## Progress Tracker

| Day | Date | Phase | Status |
|---|---|---|---|
| 1 | Apr 30 (Wed) | Local Laravel setup + base layout | [ ] Not Started |
| 2 | May 1 (Thu) | Public static pages → Blade (Home + Go-Bag) | [ ] Not Started |
| 3 | May 2 (Fri) | Migrations, models, seeders | [ ] Not Started |
| 4 | May 3 (Sat) | Auth: Breeze install + admin login + middleware | [ ] Not Started |
| 5 | May 4 (Sun) | Public Checklist page + survey logging + rule engine | [ ] Not Started |
| 6 | May 5 (Mon) | Public Feedback page + analytics endpoint | [ ] Not Started |
| 7 | May 6 (Tue) | Admin Dashboard with real Chart.js data | [ ] Not Started |
| 8 | May 7 (Wed) | Admin Feedback Management page | [ ] Not Started |
| 9 | May 8 (Thu) | Admin Checklist Rules CRUD | [ ] Not Started |
| 10 | May 9 (Fri) | Admin Tips CRUD + Go-Bag Items CRUD | [ ] Not Started |
| 11 | May 10 (Sat) | Admin Account + full security pass | [ ] Not Started |
| 12 | May 11 (Sun) | **Deploy to Railway + smoke test (TARGET)** | [ ] Not Started |
| 13 | May 12 (Mon) | QA, mobile audit, bug fixes | [ ] Not Started |
| 14 | May 13 (Tue) | **Final polish (FINAL TARGET)** | [ ] Not Started |
| 15 | May 14–15 | Buffer / safety net | [ ] Not Started |

Status legend: `[ ] Not Started` → `[~] In Progress` → `[x] Done`

---

## Phase 1 — Day 1: Local Setup & Base Layout

**Goal:** A blank Laravel app boots locally with the HandaPH navbar/footer rendered through Blade.

**Tasks**
- [ ] Install PHP 8.3, Composer, MySQL 8 locally (or via XAMPP).
- [ ] `composer create-project laravel/laravel handaph-backend "11.*"` (in a sibling directory or new branch).
- [ ] Configure `.env` for local MySQL.
- [ ] Run `php artisan migrate` to confirm DB connectivity.
- [ ] Move existing `assets/css/`, `assets/js/`, and any images into `public/assets/`.
- [ ] Create base layout `resources/views/layouts/app.blade.php` containing the public navbar + footer (extracted from `index.html`).
- [ ] Create base admin layout `resources/views/layouts/admin.blade.php` (sidebar + topbar from `admin/dashboard.html`).
- [ ] Create a placeholder `home.blade.php` extending `app.blade.php`.
- [ ] Wire route `Route::view('/', 'home')`.

**Deliverable**
`php artisan serve` → http://localhost:8000 shows the HandaPH navbar and footer with empty body.

**Test**
- Navbar links render (even if 404 on click).
- CSS loads (no console 404s).
- Footer disclaimer is visible.

---

## Phase 2 — Day 2: Static Public Pages → Blade

**Goal:** Home and Go-Bag pages render through Laravel exactly like the static versions.

**Tasks**
- [ ] Convert `index.html` body content into `home.blade.php`.
- [ ] Convert `pages/go-bag.html` body content into `go-bag.blade.php` extending `app.blade.php`.
- [ ] Add route `Route::view('/go-bag', 'go-bag')`.
- [ ] Replace all `href="./pages/foo.html"` with `{{ route('foo') }}` or `/foo`.
- [ ] Move inline SVG and Font Awesome references to use Blade includes if reused.

**Deliverable**
Home + Go-Bag pages live at `/` and `/go-bag`, visually identical to the static versions.

**Test**
- Visual diff vs. Vercel deployment — no regressions.
- Mobile viewport at 375 px still works.

---

## Phase 3 — Day 3: Database Schema

**Goal:** All 6 tables exist locally, seeded with rule data and one admin.

**Tasks**
- [ ] Create migrations:
  - `survey_submissions`
  - `checklist_rules`
  - `preparedness_tips`
  - `feedbacks`
  - `go_bag_items`
- [ ] Create Eloquent models with `$fillable` and `$casts` for JSON columns.
- [ ] Create seeders:
  - `AdminSeeder` — one user, hashed password
  - `ChecklistRulesSeeder` — port the 60+ rules from `assets/js/checklist.js`
  - `GoBagItemsSeeder` — port from `pages/go-bag.html` static content
  - `PreparednessTipsSeeder` — initial set of 10–15 tips
- [ ] Update `DatabaseSeeder` to call all seeders.
- [ ] Run `php artisan migrate:fresh --seed`.

**Deliverable**
`php artisan tinker` → `ChecklistRule::count()` returns 60+, `User::count()` returns 1.

**Test**
- All seeders run without error.
- JSON columns deserialize correctly when read back.

---

## Phase 4 — Day 4: Authentication

**Goal:** Login works; unauthenticated users hitting `/admin/*` are redirected.

**Tasks**
- [ ] `composer require laravel/breeze --dev`
- [ ] `php artisan breeze:install blade` (Blade preset, no Inertia/Vue/React).
- [ ] **Delete the registration routes and views** (we have one seeded admin only).
- [ ] **Delete the password-reset routes and views.**
- [ ] Customize `login.blade.php` to match the existing `admin/login.html` design.
- [ ] Apply `throttle:5,1` middleware to the login POST route.
- [ ] Move login route to `/admin/login`.
- [ ] Wrap all admin routes in `Route::middleware('auth')->prefix('admin')->group(...)`.
- [ ] After login redirect to `/admin/dashboard` (placeholder OK for now).
- [ ] Logout button in admin sidebar.

**Deliverable**
- Login form at `/admin/login` accepts seeded admin credentials.
- `/admin/dashboard` placeholder page is reachable only when logged in.
- Brute-force on the login form throttles after 5 tries.

**Test**
- Wrong password → error displayed.
- 6th failed attempt → throttled.
- Logout → session invalidated → cannot reach `/admin/dashboard`.

---

## Phase 5 — Day 5: Public Checklist + Survey Logging + Rule Engine

**Goal:** Public users can fill the survey, get personalized results, and the submission is logged.

**Tasks**
- [ ] Convert `pages/checklist.html` into `checklist.blade.php`.
- [ ] Add CSRF token to the form.
- [ ] Create `ChecklistController@index` (GET) and `@generate` (POST).
- [ ] Create `GenerateChecklistRequest` with validation rules for the 4 fields.
- [ ] Create `ChecklistRuleEngine` service class with `filter(array $selections): Collection`.
  - Logic mirrors the existing `matchesRule()` in `assets/js/checklist.js`.
- [ ] On POST: validate → save `SurveySubmission` → run engine → render `checklist-results.blade.php` (or return JSON for AJAX).
- [ ] Replace the JS rule engine with a small fetch call OR submit the form normally and re-render.
- [ ] Keep "Download Checklist" using `window.print()`.

**Deliverable**
End-to-end survey: user picks answers → clicks Generate → sees personalized list → row appears in `survey_submissions`.

**Test**
- All 4 questions submitted → results render.
- Skipping special needs (multi-select empty) is allowed.
- Submission row in DB matches inputs.
- Tinker: `SurveySubmission::count()` increases by 1 per click.

---

## Phase 6 — Day 6: Public Feedback + Analytics Data Endpoint

**Goal:** Feedback form submits to DB; analytics endpoint returns aggregated data.

**Tasks**
- [ ] Convert `pages/feedback.html` into `feedback.blade.php`.
- [ ] Add CSRF token; remove the `setTimeout` mock from `feedback.js`.
- [ ] Create `FeedbackController@index` and `@store`.
- [ ] Create `StoreFeedbackRequest` with validation.
- [ ] Apply `throttle:10,1` to the feedback POST.
- [ ] On success: flash message + redirect back (or return JSON if `feedback.js` uses fetch).
- [ ] Create `AnalyticsController@summary` returning JSON with 4 datasets:
  - Location distribution (count per location)
  - Household-size distribution
  - Special-needs distribution
  - House-type distribution
- [ ] Route `/admin/api/analytics` (auth-protected).

**Deliverable**
- Public feedback form stores rows.
- `/admin/api/analytics` returns valid JSON when logged in, 401/302 when not.

**Test**
- Submit feedback → DB row exists.
- Spam-rate test: 11th feedback in 1 minute is throttled.
- Hit analytics endpoint logged out → redirected to login.
- Hit logged in → JSON shape matches Chart.js expectations.

---

## Phase 7 — Day 7: Admin Dashboard

**Goal:** Live charts on `/admin/dashboard` reflect real DB data.

**Tasks**
- [ ] Convert `admin/dashboard.html` into `admin/dashboard.blade.php` extending `layouts/admin.blade.php`.
- [ ] Update `assets/js/admin-charts.js` to fetch from `/admin/api/analytics` instead of using hardcoded arrays.
- [ ] Render counter cards (Total Queries, Feedback Received, Active Tip Sets) using server-side counts injected via Blade.
- [ ] Make sure auth check happens before chart fetch.

**Deliverable**
Logged-in admin sees four charts with real numbers and three counter cards with live counts.

**Test**
- Submit a survey publicly → refresh dashboard → counts increase.
- Charts render without console errors.

---

## Phase 8 — Day 8: Admin Feedback Management

**Goal:** Admin can browse, filter, and search feedback submissions.

**Tasks**
- [ ] Convert `admin/feedback-management.html` into Blade view.
- [ ] Controller fetches `Feedback::with(...)->latest()->paginate(20)`.
- [ ] Apply rating + region filters from query string.
- [ ] Stat counters at top (avg rating, total submissions, % "very easy").
- [ ] Display written suggestions in a separate table.

**Deliverable**
Admin sees real feedback rows. Filters work via GET query params.

**Test**
- Submit varied feedback publicly → all appears in admin.
- Filter by rating=5 → only 5-star rows show.
- Pagination works past 20 rows.

---

## Phase 9 — Day 9: Admin Checklist Rules CRUD

**Goal:** Admin can add, edit, delete rules. Public checklist reflects changes immediately.

**Tasks**
- [ ] Convert `admin/checklist-items.html` into `admin/checklist-rules.blade.php`.
- [ ] Expand the form to include: `phase`, `tag`, `tag_class`, multi-select `locations`, `sizes`, `special_needs`, `house_types`, `is_active`.
- [ ] Create `ChecklistRuleController` with `index`, `store`, `update`, `destroy`.
- [ ] Create `StoreChecklistRuleRequest` and `UpdateChecklistRuleRequest`.
- [ ] Use Bootstrap modal for create/edit (matches existing admin UI).
- [ ] Add confirmation modal for delete.

**Deliverable**
Full CRUD: admin creates a rule with `location=["coastal"]` → submits public survey with `coastal` → new rule appears in results.

**Test**
- Create rule → appears in table.
- Edit rule → changes persist.
- Delete rule → row removed; public survey no longer returns it.
- Toggle `is_active=false` → rule excluded from public results.

---

## Phase 10 — Day 10: Admin Tips CRUD + Go-Bag Items CRUD

**Goal:** Two more CMS surfaces, identical pattern to Day 9.

**Tasks (Tips)**
- [ ] Convert `admin/preparedness-tips.html` to Blade.
- [ ] Controller + requests + modals (mirrors Day 9 pattern).

**Tasks (Go-Bag Items)**
- [ ] New admin page `admin/go-bag-items.blade.php`.
- [ ] Add sidebar link.
- [ ] Controller + requests + modals.
- [ ] Update public `go-bag.blade.php` to read from `go_bag_items` table grouped by category.

**Deliverable**
- Tips CRUD live.
- Go-Bag CRUD live; public page reflects edits.

**Test**
- Create a "Recommended" Go-Bag item → appears under Recommended tab on public page.
- Toggle `is_active=false` → hidden on public page.

---

## Phase 11 — Day 11: Admin Account + Security Pass

**Goal:** Admin can update their own profile. All security checklist items confirmed.

**Tasks**
- [ ] Convert `admin/admin-account.html` to Blade.
- [ ] Form fields: name, email, current password, new password, confirm new password.
- [ ] Validation: current password must match before any change.
- [ ] Run full security checklist from `handaph-backend-agreement.md` §6 — verify each one.
- [ ] Set production env values: `APP_DEBUG=false`, `APP_ENV=production`, `SESSION_SECURE_COOKIE=true`.
- [ ] Confirm Breeze registration and password-reset routes are deleted.
- [ ] Confirm rate limits work.
- [ ] Confirm `auth` middleware on every admin route (audit `php artisan route:list`).

**Deliverable**
Admin can change own credentials. Security checklist 17/17 confirmed.

**Test**
- Change password → re-login required with new password.
- `php artisan route:list --columns=method,uri,middleware` shows `auth` on all `/admin/*`.

---

## Phase 12 — Day 11 (May 11): Deploy to Railway

**This is the target completion day.**

**Tasks**
- [ ] Push `claude/analyze-handaph-codebase-P6ixN` branch to GitHub.
- [ ] Create Railway project from GitHub.
- [ ] Add MySQL plugin → confirm env vars auto-injected.
- [ ] Set additional env vars in Railway dashboard:
  - `APP_KEY` (generate locally with `php artisan key:generate --show`)
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_URL=https://<subdomain>.up.railway.app`
  - `SESSION_SECURE_COOKIE=true`
  - `SESSION_DRIVER=database` (recommended for Railway)
- [ ] Add `nixpacks.toml` or rely on auto-detect for build/start commands.
- [ ] First deploy → watch logs.
- [ ] Run migrations + seeder via Railway shell or one-off command.
- [ ] Smoke-test:
  - Public home loads
  - Survey submits and stores
  - Feedback submits
  - Admin login works
  - Dashboard charts load
  - All CRUD pages function

**Deliverable**
Live URL: `https://<subdomain>.up.railway.app`. Working end-to-end.

---

## Phase 13 — Day 12 (May 12): QA & Bug Fixes

**Goal:** Resolve any production issues; ensure mobile parity.

**Tasks**
- [ ] Mobile audit at 375 px / 390 px / 768 px / 1280 px.
- [ ] Cross-browser: Chrome, Firefox, Mobile Safari.
- [ ] Fix any visual regressions vs. the Vercel front-end.
- [ ] Verify "Download Checklist" print stylesheet still works.
- [ ] Re-run security checklist on the deployed app.

---

## Phase 14 — Day 13 (May 13): Final Polish

**This is the final-target day. Everything below is buffer.**

**Tasks**
- [ ] Update README.md with backend setup instructions.
- [ ] Document admin login URL and how to seed a new admin if needed.
- [ ] Confirm both markdown plan documents are up to date.
- [ ] Tag a release in git.

---

## Days 14–15 (May 14–15): Buffer

Reserved for unexpected issues. **Do not schedule new work here.**

---

## Risk Register

| Risk | Likelihood | Mitigation |
|---|---|---|
| Railway free credit exhausted | Low | Monitor usage daily after Day 12; upgrade tier if needed |
| MySQL JSON-column queries underperform | Low | Indexes; small data volume in v1 |
| Admin CRUD for rules takes longer than 1 day | Medium | Use scaffolded forms; reuse Bootstrap modal pattern |
| Blade migration breaks existing CSS | Medium | Day 2 visual diff catches early; preserve all class names |
| Deployment fails on Day 12 | Medium | Test deploy on Day 11 evening if possible |
| Scope creep | High | Reject all out-of-scope features; reference Agreement §10 |

---

## Daily Working Rhythm

1. Open this file and the Agreement file.
2. Identify today's phase.
3. I send the first code block in chat.
4. You type → save → test → confirm.
5. Repeat until phase deliverable is met.
6. Update the **Status** column for the day.
7. Stop when the phase is done. Do not pull tomorrow's tasks forward unless ahead of schedule.

---

## Definition of Done (per phase)

A phase is done when:
- All tasks checked.
- Deliverable verified.
- All listed tests pass.
- Code committed to the working branch with a descriptive message.
- Status updated in the tracker above.
