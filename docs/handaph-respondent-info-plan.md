# Implementation Plan: Add Respondent Info to Feedback Form

Add "Name" and "Course & Section" fields to the public feedback form so the admin can see who submitted each evaluation, while keeping the system fully anonymous (no login required).

## Handling Existing Data

> [!IMPORTANT]
> **Existing feedback rows will NOT be deleted or lost.** The new `respondent_name` and `course_section` columns will be added as **nullable** fields. This means:
> - All existing submissions will simply show "Anonymous" (or blank) in the new columns.
> - New submissions going forward will have the respondent's name and course/section attached.
> - The analytics computations (means, interpretations, charts) remain unaffected since they only use the rating columns.
>
> **No data migration or backfill is needed.**

## Open Questions

> [!IMPORTANT]
> **Should the Name and Course & Section fields be required or optional?** My plan assumes they will be **required** so every new submission is identifiable. If you'd prefer them to be optional (letting users stay anonymous if they choose), let me know and I'll adjust the validation.

## Proposed Changes

### 1. Database Migration
#### [NEW] database/migrations/xxxx_add_respondent_info_to_feedbacks_table.php
- Add two **nullable** columns to the `feedbacks` table:
  - `respondent_name` (string, nullable)
  - `course_section` (string, nullable)
- Nullable so existing rows remain valid without modification.

---

### 2. Model Update
#### [MODIFY] [Feedback.php](file:///c:/websystem/HandaPH/app/Models/Feedback.php)
- Add `'respondent_name'` and `'course_section'` to the `$fillable` array.

---

### 3. Public Feedback Form
#### [MODIFY] [StoreFeedbackRequest.php](file:///c:/websystem/HandaPH/app/Http/Requests/StoreFeedbackRequest.php)
- Add validation rules: `'respondent_name' => ['required', 'string', 'max:255']` and `'course_section' => ['required', 'string', 'max:255']`.

#### [MODIFY] [feedback.blade.php](file:///c:/websystem/HandaPH/resources/views/feedback.blade.php)
- Add a "Respondent Information" section at the top of the form (before the rating scale) with:
  - **Name** — text input (`respondent_name`)
  - **Course & Section** — text input (`course_section`)

---

### 4. Admin Dashboard
#### [MODIFY] [feedback-management.blade.php](file:///c:/websystem/HandaPH/resources/views/admin/feedback-management.blade.php)
- Add "Name" and "Course & Section" columns to the Raw Submissions table.
- Add "Name" column to the Written Comments table.
- Existing anonymous submissions will display "Anonymous" via a Blade fallback (`$fb->respondent_name ?? 'Anonymous'`).

#### [MODIFY] [feedback-export.blade.php](file:///c:/websystem/HandaPH/resources/views/admin/feedback-export.blade.php)
- Add the same Name and Course & Section columns to the export tables so PDF and Excel outputs include respondent info.

---

## Verification Plan

### Manual Verification
1. Run `php artisan migrate` locally to confirm the migration adds the columns without errors.
2. Submit a new evaluation on the public form and verify the name/course fields are saved.
3. Check the Admin Feedback Management page to confirm name and course appear in the table.
4. Verify that old (existing) submissions show "Anonymous" gracefully.
5. Export to PDF and Excel to confirm the new columns are included.
