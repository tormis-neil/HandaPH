# HandaPH — Backend Development Plan (Compressed 8-Day Schedule)

**Companion to:** `handaph-backend-agreement.md`
**Build window:** May 4 – May 11, 2026 (8 focused dev days) / May 12 (target) / May 15 (hard deadline)
**Branch:** `claude/analyze-handaph-codebase-P6ixN`

This is the day-by-day execution guide. The original 14-day plan was compressed to 8 dev days because the developer's actual focused-work window is shorter than calendar days. Each phase has a deliverable, files touched, and a testing checklist. Update the **Status** column as we go.

---

## Progress Tracker

| Day | Date | Phase | Status |
|---|---|---|---|
| 1 | May 4 (Mon) | Foundation + Static Pages | [ ] Not Started |
| 2 | May 5 (Tue) | Schema + Auth | [ ] Not Started |
| 3 | May 6 (Wed) | Public Checklist + Rule Engine | [ ] Not Started |
| 4 | May 7 (Thu) | Public Feedback + Analytics + Admin Dashboard | [ ] Not Started |
| 5 | May 8 (Fri) | Admin Feedback Mgmt + Checklist Rules CRUD | [ ] Not Started |
| 6 | May 9 (Sat) | Admin Tips CRUD + Go-Bag CRUD + Admin Account | [ ] Not Started |
| 7 | May 10 (Sun) | Security Pass + Deploy to Railway | [ ] Not Started |
| 8 | May 11 (Mon) | QA + Polish | [ ] Not Started |
| **Target** | **May 12 (Tue)** | **🎯 Final hand-off** | — |
| Safety net | May 13–15 | Hard deadline buffer (May 15 is the absolute cutoff) | — |

Status legend: `[ ] Not Started` → `[~] In Progress` → `[x] Done`

---

## Day 1 — May 4 (Mon): Foundation + Static Pages

**Goal:** Laravel boots locally, navbar/footer rendered through Blade, Home and Go-Bag pages live at their public routes.

### Tasks
- [ ] Confirm prerequisites: PHP 8.3+, Composer, MySQL 8, Git.
- [ ] `composer create-project laravel/laravel handaph-backend "11.*"`.
- [ ] Configure `.env` for local MySQL (DB name, user, password).
- [ ] Run `php artisan migrate` to confirm DB connectivity (no tables yet, just a connection check).
- [ ] Move existing `assets/css/`, `assets/js/`, and any images into `public/assets/`.
- [ ] Create `resources/views/layouts/app.blade.php` — public navbar + footer extracted from `index.html`.
- [ ] Create `resources/views/layouts/admin.blade.php` — sidebar + topbar from `admin/dashboard.html`.
- [ ] Create `resources/views/home.blade.php` extending `layouts.app` with the Home page body content from `index.html`.
- [ ] Create `resources/views/go-bag.blade.php` extending `layouts.app` with the body content from `pages/go-bag.html` (still static — DB-driven version comes Day 6).
- [ ] Wire routes:
  - `Route::view('/', 'home')->name('home');`
  - `Route::view('/go-bag', 'go-bag')->name('go-bag');`
- [ ] Replace all `href="./pages/foo.html"` and `./index.html` with `{{ route('foo') }}` or `/`.

### Deliverable
`php artisan serve` → http://localhost:8000 shows Home with HandaPH navbar and footer; `/go-bag` works; visual parity with the Vercel deployment.

### Tests
- Navbar and footer render correctly.
- CSS loads (no console 404s).
- Mobile viewport at 375 px still works.
- All internal links resolve (no 404s).

### Risk
**Low.** This is the lightest day on purpose — gives us margin for any local environment issues.

---

## Day 2 — May 5 (Tue): Schema + Auth ⚠️ HEAVIEST DAY

**Goal:** All 6 tables exist with seed data; admin login works; `/admin/*` is protected.

### Schema tasks
- [ ] Create migrations:
  - `survey_submissions`
  - `checklist_rules`
  - `preparedness_tips`
  - `feedbacks`
  - `go_bag_items`
  - (the default `users` migration is already present)
- [ ] Create Eloquent models with `$fillable` and `$casts` for JSON columns.
- [ ] Create seeders:
  - `AdminSeeder` — one user, hashed password
  - `ChecklistRulesSeeder` — port the 60+ rules from `assets/js/checklist.js`
  - `GoBagItemsSeeder` — port from `pages/go-bag.html` static content
  - `PreparednessTipsSeeder` — initial 10–15 tips
- [ ] Update `DatabaseSeeder` to call all seeders.
- [ ] Run `php artisan migrate:fresh --seed`.

### Auth tasks
- [ ] `composer require laravel/breeze --dev`.
- [ ] `php artisan breeze:install blade` (Blade preset, no Inertia/Vue/React).
- [ ] **Delete the registration routes and views.**
- [ ] **Delete the password-reset routes and views.**
- [ ] Customize `login.blade.php` to match `admin/login.html` design.
- [ ] Move the login route to `/admin/login`.
- [ ] Apply `throttle:5,1` middleware to the login POST route.
- [ ] Wrap all admin routes in `Route::middleware('auth')->prefix('admin')->group(...)`.
- [ ] After login, redirect to `/admin/dashboard` (placeholder OK for now).
- [ ] Logout button hooked into the admin sidebar layout.

### Deliverable
- `php artisan tinker` → `ChecklistRule::count()` returns 60+, `User::count()` returns 1.
- Login at `/admin/login` with seeded credentials redirects to `/admin/dashboard` (placeholder).
- Direct access to `/admin/dashboard` while logged out redirects to login.

### Tests
- All seeders run without error.
- JSON columns deserialize correctly when read back.
- Wrong password shows error.
- 6th failed login is throttled.
- Logout invalidates session.

### Risk
**Highest of the schedule.** If it spills, it eats into Day 3. **Mitigation:** all code blocks for this day will be sent grouped and pre-ordered; do not improvise sequencing.

---

## Day 3 — May 6 (Wed): Public Checklist + Rule Engine

**Goal:** Public users complete the survey, submission is logged, personalized results render from DB-driven rules.

### Tasks
- [ ] Convert `pages/checklist.html` body into `resources/views/checklist.blade.php`.
- [ ] Add `@csrf` to the form.
- [ ] Create `ChecklistController` with `index` (GET) and `generate` (POST).
- [ ] Create `GenerateChecklistRequest` Form Request with validation rules for the 4 fields.
- [ ] Create `App\Services\ChecklistRuleEngine` service class with `filter(array $selections): Collection`.
  - Logic mirrors the existing `matchesRule()` in `assets/js/checklist.js`.
  - Filters by `is_active = true`.
- [ ] On POST: validate → save `SurveySubmission` → run engine → render `checklist-results.blade.php` partial.
- [ ] Update existing `assets/js/checklist.js` to submit the form to the new endpoint instead of running rules in the browser.
- [ ] Keep "Download Checklist" using `window.print()` (no change).

### Deliverable
End-to-end survey: user picks answers → clicks Generate → personalized list renders → row appears in `survey_submissions`.

### Tests
- All 4 questions submitted → results render.
- Skipping special needs (multi-select empty) is allowed.
- Submission row in DB matches inputs.
- `SurveySubmission::count()` increases by 1 per click.
- Setting `is_active=false` on a rule (via Tinker) excludes it from results.

### Risk
**Medium.** The rule engine port is the biggest unknown. Test with at least one rule from each category (location-specific, size-specific, needs-specific, house-type-specific) before declaring done.

---

## Day 4 — May 7 (Thu): Public Feedback + Analytics Endpoint + Admin Dashboard

**Goal:** Feedback submits to DB; analytics endpoint returns aggregated data; admin dashboard shows live charts.

### Feedback tasks
- [ ] Convert `pages/feedback.html` body into `resources/views/feedback.blade.php`.
- [ ] Add `@csrf`; remove the `setTimeout` mock from `feedback.js`.
- [ ] Create `FeedbackController` with `index` and `store`.
- [ ] Create `StoreFeedbackRequest` with validation.
- [ ] Apply `throttle:10,1` to the feedback POST route.
- [ ] On success: flash message + redirect back (or return JSON if `feedback.js` uses fetch).

### Analytics endpoint tasks
- [ ] Create `AnalyticsController@summary` returning JSON with 4 datasets:
  - Location distribution (count per location)
  - Household-size distribution
  - Special-needs distribution (counts where each tag is present in JSON column)
  - House-type distribution
- [ ] Route `/admin/api/analytics` (auth-protected).

### Dashboard tasks
- [ ] Convert `admin/dashboard.html` into `resources/views/admin/dashboard.blade.php` extending `layouts.admin`.
- [ ] Update `assets/js/admin-charts.js` to fetch from `/admin/api/analytics` instead of using hardcoded arrays.
- [ ] Render counter cards (Total Queries, Feedback Received, Active Tip Sets) with server-side counts injected via Blade.
- [ ] Use `credentials: 'same-origin'` on the fetch so the session cookie is sent.

### Deliverable
- Public feedback form stores rows.
- `/admin/api/analytics` returns valid JSON when logged in, redirects to login when not.
- Logged-in admin sees four charts with real numbers and three counter cards with live counts.

### Tests
- Submit feedback → DB row exists.
- 11th feedback in 1 minute is throttled.
- Hit analytics endpoint logged out → redirected to login.
- Submit a survey publicly → refresh dashboard → counts update.
- Charts render without console errors.

### Risk
**Medium-High.** Three features in one day. **Mitigation:** keep `admin-charts.js`'s existing chart shape; only swap the data source.

---

## Day 5 — May 8 (Fri): Admin Feedback Management + Checklist Rules CRUD

**Goal:** Admin can browse/filter feedback; full CRUD on checklist rules works end-to-end.

### Feedback management tasks
- [ ] Convert `admin/feedback-management.html` into Blade.
- [ ] Controller fetches `Feedback::latest()->paginate(20)`.
- [ ] Apply rating + region filters from query string.
- [ ] Stat counters at top (avg rating, total submissions, % "very easy").
- [ ] Display written suggestions in a separate table.

### Checklist rules CRUD tasks
- [ ] Convert `admin/checklist-items.html` into `admin/checklist-rules.blade.php`.
- [ ] Expand the form to include: `phase`, `tag`, `tag_class`, multi-select `locations`, `sizes`, `special_needs`, `house_types`, `is_active`.
- [ ] Create `ChecklistRuleController` with `index`, `store`, `update`, `destroy`.
- [ ] Create `StoreChecklistRuleRequest` and `UpdateChecklistRuleRequest`.
- [ ] Use Bootstrap modal for create/edit (matches existing admin UI).
- [ ] Add confirmation modal for delete.

### Deliverable
- Admin sees real feedback rows with working filters and pagination.
- Full CRUD: admin creates a rule with `location=["coastal"]` → submits public survey with `coastal` → new rule appears in results.

### Tests
- Submit varied feedback publicly → all appears in admin.
- Filter by rating=5 → only 5-star rows show.
- Pagination works past 20 rows.
- Rule create/edit/delete cycle persists correctly.
- `is_active=false` rule excluded from public results.

### Risk
**High.** Rules CRUD is the most complex form in the app (4 multi-selects). **Mitigation:** keep the modal layout simple — checkboxes, not custom UI widgets.

---

## Day 6 — May 9 (Sat): Tips CRUD + Go-Bag CRUD + Admin Account

**Goal:** Two more CMS surfaces and the admin profile page. This day should run under schedule because the patterns are reused from Day 5.

### Tips CRUD tasks
- [ ] Convert `admin/preparedness-tips.html` to Blade.
- [ ] Controller + requests + modals (mirrors Day 5 rules pattern).

### Go-Bag CRUD tasks
- [ ] New admin page `resources/views/admin/go-bag-items.blade.php`.
- [ ] Add sidebar link in `layouts.admin`.
- [ ] Controller + requests + modals.
- [ ] Update public `go-bag.blade.php` to read from `go_bag_items` grouped by category.

### Admin account tasks
- [ ] Convert `admin/admin-account.html` to Blade.
- [ ] Form fields: name, email, current password, new password, confirm new password.
- [ ] Validation: current password must match before any change.

### Deliverable
- Tips CRUD live.
- Go-Bag CRUD live; public Go-Bag page reflects edits.
- Admin can change own credentials.

### Tests
- Create a "Recommended" Go-Bag item → appears under Recommended tab on public page.
- Toggle `is_active=false` → hidden on public page.
- Change admin password → re-login required with new password.
- Wrong current password rejects the change.

### Risk
**Low-Medium.** Pattern reuse from Day 5 makes this fast. If Day 5 ran long, account page can slip into Day 7's morning.

---

## Day 7 — May 10 (Sun): Security Pass + Deploy to Railway

**Goal:** Application live on Railway with all 17 security items confirmed.

### Security pass tasks (verification, not new code)
- [ ] Walk every item in `handaph-backend-agreement.md` §6 — confirm each is in place.
- [ ] Audit `php artisan route:list --columns=method,uri,middleware` — every `/admin/*` route has `auth`.
- [ ] Confirm Breeze registration and password-reset routes are deleted.
- [ ] Confirm rate limits work (login throttle, feedback throttle).
- [ ] Set production-bound config: `APP_DEBUG=false`, `APP_ENV=production`, `SESSION_SECURE_COOKIE=true`, `SESSION_HTTP_ONLY=true`, `SESSION_SAME_SITE=lax`.

### Deployment tasks
- [ ] Push branch to GitHub.
- [ ] Create Railway project from GitHub.
- [ ] Add MySQL plugin → confirm env vars auto-injected.
- [ ] Set additional env vars in Railway dashboard:
  - `APP_KEY` (generate locally with `php artisan key:generate --show`)
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_URL=https://<subdomain>.up.railway.app`
  - `SESSION_SECURE_COOKIE=true`
  - `SESSION_DRIVER=database`
- [ ] Add `nixpacks.toml` (or rely on auto-detect) for build/start commands.
- [ ] First deploy → watch logs.
- [ ] Run migrations + seeder via Railway shell or one-off command.
- [ ] Smoke-test on the live URL:
  - Public home loads
  - Survey submits and stores
  - Feedback submits
  - Admin login works
  - Dashboard charts load
  - Each CRUD page functions

### Deliverable
Live URL: `https://<subdomain>.up.railway.app`. All public and admin flows working.

### Risk
**Single-point-of-failure day.** If deploy fails late and we cannot resolve same-day, slippage is one day. **Mitigation:** if Day 6 finishes early, attempt a *trial* deploy that evening so Thursday is a known re-deploy.

---

## Day 8 — May 11 (Mon): QA + Polish

**Goal:** Production app is bug-free across browsers and devices.

### Tasks
- [ ] Mobile audit on the live URL at 375 px / 390 px / 768 px / 1280 px.
- [ ] Cross-browser test: Chrome, Firefox, Mobile Safari (iOS).
- [ ] Visual diff vs. the existing Vercel front-end — fix any regressions.
- [ ] Verify "Download Checklist" print stylesheet still works in production.
- [ ] Re-run the 17-item security checklist on the live deployment.
- [ ] Update `README.md` with backend setup instructions and the live URL.
- [ ] Tag a git release.

### Deliverable
Production site passes QA across all target devices and browsers; README updated; release tagged.

### Risk
**Low.** This is a fixing day, not a building day.

---

## 🎯 Day 9 — May 12 (Tue): TARGET

Final hand-off. Application is complete, tested, deployed, documented.

---

## Days 10–12 — May 13–15: Safety Net

Used only if a day slipped during the build window (May 4–11). Hard deadline is May 15. **Do not schedule new work here.**

---

## Risk Register

| Risk | Likelihood | Mitigation |
|---|---|---|
| Day 2 (schema + auth) spills into Day 3 | Medium-High | All code blocks sent pre-ordered; if it spills, take from the May 13–15 safety net immediately |
| Day 4 (3 features) breaks one of the three | Medium | Build feedback first (simplest), then analytics endpoint, then dashboard |
| Day 5 rules CRUD takes longer than expected | Medium | Keep multi-selects as plain checkboxes; no fancy widgets |
| Railway deploy fails on Day 7 (May 10) | Medium | Trial deploy on Day 6 (May 9) evening if it finishes early |
| Railway free credit exhausted | Low | Monitor usage daily after Day 7 |
| Scope creep | High | Reject everything outside `handaph-backend-agreement.md` §10 |
| Visual regression after Blade migration | Medium | Day 1 visual diff; preserve all class names exactly |

---

## Daily Working Rhythm

1. Open this file and the Agreement file at start of day.
2. Identify today's phase — read tasks, deliverable, and tests.
3. I send the first code block in chat with file path, action, code, explanation, and test step.
4. You type → save → test → confirm.
5. Repeat until phase deliverable is met.
6. Update the **Status** column at end of day.
7. Stop when the phase is done — do not pull tomorrow's tasks forward unless ahead of schedule and explicitly agreed.

---

## Definition of Done (per phase)

A phase is done when:
- All tasks checked.
- Deliverable verified manually.
- All listed tests pass.
- Code committed to the working branch with a descriptive message.
- Status updated in the tracker above.
