# Task List: Add Respondent Info to Feedback

- [x] Create migration to add `respondent_name` and `course_section` columns to `feedbacks` table.
- [x] Update `Feedback` model `$fillable` array.
- [x] Update `StoreFeedbackRequest` validation rules.
- [x] Update public `feedback.blade.php` form with Name and Course & Section inputs.
- [x] Update admin `feedback-management.blade.php` to show respondent info in tables.
- [x] Update `feedback-export.blade.php` to include respondent info in PDF/Excel exports.
- [x] Test locally with `php artisan migrate`.
- [x] Commit and push to trigger Render deployment.
