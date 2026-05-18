# Implementation Plan: ISO/IEC 25010 System Evaluation Analytics

This plan outlines the steps to implement a complete evaluation tallying and analytics system for the admin dashboard based on the ISO/IEC 25010:2011 Quality in Use Model.

The goal is to revamp the existing feedback module to accurately compute criterion averages, category means, overall means, and map these to standard verbal interpretations. It will also introduce demographic data collection, advanced dashboard visualizations, filtering, and Excel export functionality.

## Open Questions

> [!IMPORTANT]  
> **Demographic Data Collection:** The requirements mention filtering by *respondent type* and *course/section*. Currently, the public feedback form is completely anonymous and does not ask for these details. 
> 
> **Question:** Should we add "Respondent Type" (e.g., Student, Teacher, Guest) and "Course/Section" as fields in the public feedback form so anonymous users can fill them out, or should the feedback form require users to be logged in to pull this data automatically? My plan assumes we will add these as fields to the public form.

> [!IMPORTANT]  
> **Chart Library:** I plan to use **Chart.js** (via a CDN link) to render the required bar charts, pie charts, and average rating graphs on the admin dashboard. Is this acceptable, or do you have a preferred charting library already installed?

## Proposed Changes

### 1. Database & Model Updates
We need to track demographics for the filtering requirements.
#### [NEW] database/migrations/xxxx_xx_xx_xxxxxx_add_demographics_to_feedbacks_table.php
- Create a new migration to append `respondent_type` and `course_section` (nullable) columns to the existing `feedbacks` table.
#### [MODIFY] app/Models/Feedback.php
- Add the new demographic fields to the `$fillable` array.
- Add helper methods or accessors (if needed) to map numerical scores to their verbal interpretations.

### 2. Public Form Updates
#### [MODIFY] resources/views/feedback.blade.php
- Add form inputs for `respondent_type` (dropdown: Student, Faculty, Staff, Guest, etc.) and `course_section` (text input).
#### [MODIFY] app/Http/Requests/StoreFeedbackRequest.php
- Add validation rules for the new demographic fields.

### 3. Analytics & Tallying Logic (Backend)
#### [MODIFY] app/Http/Controllers/Admin/FeedbackController.php
- **Tallying Logic**: Update the `index` method to calculate:
  - Total respondents and sum of ratings for every single criterion.
  - Mean for each criterion (`Average = Total Score / Total Respondents`).
- **Category Computation Logic**:
  - `Effectiveness Mean` (1 criterion)
  - `Efficiency Mean` (1 criterion)
  - `Satisfaction Mean` = `(Usefulness + Trust + Pleasure + Comfort) / 4`
  - `Freedom from Risk Mean` = `(Economic + Health/Safety + Environmental) / 3`
  - `Context Coverage Mean` (1 criterion)
  - `Flexibility Mean` (1 criterion)
- **Overall Mean Logic**: 
  - `Overall System Mean` = Sum of the 6 category means / 6.
- **Interpretation Logic**: Create a private helper method inside the controller to map any computed mean to its verbal interpretation:
  - `4.50 – 5.00` = Highly Acceptable
  - `3.50 – 4.49` = Acceptable
  - `2.50 – 3.49` = Moderately Acceptable
  - `1.50 – 2.49` = Slightly Acceptable
  - `1.00 – 1.49` = Not Acceptable
- **Filtering**: Apply Eloquent query scopes based on `respondent_type`, `course_section`, and `created_at` (date ranges) submitted via GET parameters.

### 4. Admin Dashboard UI
#### [MODIFY] resources/views/admin/feedback-management.blade.php
- **Filters**: Add a top filter bar for Date Range, Respondent Type, and Course/Section.
- **Statistics Cards**: Show Total Respondents and Overall System Mean (with interpretation).
- **Tally Tables (Excel-style)**: Create tables displaying:
  1. Criterion Name
  2. Total Score (Sum)
  3. Computed Mean
  4. Verbal Interpretation
- **Category Summary Table**: Show the aggregated category means and interpretations.
- **Charts/Graphs**: Integrate Chart.js to display:
  - Bar chart for Category Averages.
  - Pie chart for Respondent Demographics.
  - Radar or Line graph for individual criteria comparison.

### 5. Export Functionality
#### [NEW] app/Exports/FeedbackExport.php
- Install `maatwebsite/excel` (Laravel Excel) if not already present.
- Create an Export class that maps the tallied data, interpretations, and raw responses into a formatted Excel sheet.
#### [MODIFY] routes/admin.php
- Add the route for downloading the Excel export.
- (Optional) Update the existing PDF export to reflect the new ISO/IEC 25010 tabular formats.

---

## Verification Plan

### Automated/Code Verification
- Ensure the migration runs without errors.
- Verify that `maatwebsite/excel` installs successfully and doesn't conflict with existing packages.

### Manual Verification
1. Submit multiple test feedbacks on the public form with varying demographic data.
2. Navigate to the Admin Feedback Management page.
3. Manually calculate the math for a subset of the data to ensure the Controller logic strictly adheres to the formulas:
   - Average = Total / Respondents
   - Category Mean = Sum of criteria means / number of criteria
   - Overall Mean = Sum of Category means / 6
4. Verify that interpretations match the exact 1.0-5.0 scale ranges provided.
5. Test the filter dropdowns to ensure the charts and tables recalculate dynamically based on the filtered subset of data.
6. Export the data to PDF and Excel to verify the formatting.
