# HandaPH — Front-End Development Standards & Best Practices

## Project Tech Stack
- **Frontend:** HTML5, CSS3, Bootstrap 5, Vanilla JavaScript
- **Backend:** PHP (form processing, admin authentication)
- **Database:** MySQL
- **Charts:** Chart.js
- **Editor:** VSCode + XAMPP
- **Font:** Inter or Roboto via Google Fonts

---

## Project Folder Structure

```
/handaph
  /assets
    /css
      style.css
    /js
      checklist.js
      gobag.js
      feedback.js
      admin-charts.js
    /img
  /admin
    login.html
    dashboard.html
    feedback-management.html
    checklist-items.html
    preparedness-tips.html
  /pages
    checklist.html
    go-bag.html
    feedback.html
  index.html
```

---

## HTML Best Practices

### Document Structure
- Always declare `<!DOCTYPE html>` on line 1 of every HTML file
- Always set the `lang` attribute on the `<html>` tag:
  ```html
  <html lang="en">
  ```
- Always include charset and viewport meta tags in `<head>`:
  ```html
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  ```
- Every page must have a unique, descriptive `<title>` tag:
  ```html
  <title>HandaPH — Be Ready Before the Storm</title>
  ```

### Semantic Elements
- Use semantic elements correctly — `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`
- Never use `<div>` where a semantic element fits
- One `<h1>` per page only. Heading hierarchy must never skip levels (h1 → h2 → h3, never h1 → h3)
- Never use headings just to make text large — use CSS for sizing
- Use `<ul>` or `<ol>` for actual lists, not fake lists made with `<br>` tags

### Attributes
- All `<img>` tags must have a descriptive `alt` attribute. If purely decorative, use `alt=""`
- All `<a>` tags must have meaningful link text. Never use "click here" or "read more"
- Every `<input>` must have an associated `<label>` — either wrapping it or via `for`/`id` pairing:
  ```html
  <label for="email">Email Address</label>
  <input type="email" id="email" name="email">
  ```
- Use `id` sparingly — only for unique elements (one per page). Use `class` for reusable styles
- Always quote attribute values with double quotes

### File Paths
- Use relative paths for all internal assets:
  ```html
  <link rel="stylesheet" href="./assets/css/style.css">
  ```
- Never hardcode `localhost` or absolute server paths inside HTML
- All filenames: lowercase, hyphens for spaces — `go-bag.html`, `checklist.js`, `hero-bg.jpg`
- No spaces, no uppercase, no underscores in filenames

### Accessibility (a11y)
- All form inputs must have visible, associated labels
- Use `aria-label` on icon-only buttons:
  ```html
  <button aria-label="Close menu"><i class="fas fa-times"></i></button>
  ```
- Color contrast must meet WCAG AA minimum (4.5:1 ratio for body text)
  - Slate Navy `#1E293B` on Soft White `#F8FAFC` passes at 16.75:1 ✓
- All interactive elements (buttons, links) must be keyboard-navigable
- Never remove the default focus outline without replacing it with a visible custom style:
  ```css
  :focus-visible {
    outline: 2px solid var(--color-secondary);
    outline-offset: 2px;
  }
  ```
- Use `role` attributes when a non-semantic element is used interactively

### HTML Comments
- Use comments only to mark major sections, not every line:
  ```html
  <!-- ===== HERO SECTION ===== -->
  <!-- ===== FEATURES SECTION ===== -->
  ```
- Never leave commented-out dead code in submitted files

---

## CSS Best Practices

### File Organization
- One external stylesheet: `assets/css/style.css`
- Never use inline `style=""` attributes in HTML except as an absolute last resort
- Never use `<style>` blocks inside HTML files
- Group CSS in this order:
  1. CSS Variables (`:root`)
  2. Reset / Base styles
  3. Typography
  4. Layout (Navbar, Footer)
  5. Page-specific components
  6. Utilities
  7. Media Queries

### CSS Custom Properties (Variables)
Define all brand colors at the top of `style.css`. Never hardcode hex values more than once:
```css
:root {
  /* Brand Colors */
  --color-primary: #1E293B;       /* Slate Navy — headers, nav, footer */
  --color-secondary: #EA580C;     /* Safety Orange — CTA buttons */
  --color-background: #F8FAFC;    /* Soft White — page background */
  --color-danger: #DC2626;        /* Emergency Red — important reminders only */

  /* Text Colors */
  --color-text: #1E293B;
  --color-text-muted: #64748B;

  /* Spacing */
  --spacing-sm: 0.5rem;
  --spacing-md: 1rem;
  --spacing-lg: 2rem;

  /* Border Radius */
  --radius-md: 8px;
  --radius-lg: 12px;
}
```

### Global Reset
Always include this at the top of `style.css` after variables:
```css
*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Inter', 'Roboto', sans-serif;
  background-color: var(--color-background);
  color: var(--color-text);
  line-height: 1.6;
}

img {
  max-width: 100%;
  height: auto;
  display: block;
}
```

### Selectors
- Prefer class selectors over element selectors for component styling
- Never use `!important` unless absolutely necessary — add a comment explaining why when you do
- Keep selector specificity low — avoid nesting more than 3 levels deep
- Use descriptive class names that reflect purpose, not appearance:
  ```css
  /* Good */
  .checklist-step { }
  .go-bag-card { }
  .nav-link--active { }

  /* Avoid */
  .blue-box { }
  .big-text { }
  ```

### Typography
- Set base font in the `body` selector — elements inherit from it
- Use `rem` units for font sizes (accessible when users adjust browser font size)
- Use `em` for padding and margin inside components
- Use `px` only for borders and box shadows

### Layout
- Use Bootstrap's grid (`container` → `row` → `col-*`) for all page-level layouts
- Use CSS Flexbox for component-level alignment (centering, nav bars, card rows)
- Never use HTML `<table>` for layout — tables are only for actual tabular data
- Use CSS Grid only for complex two-dimensional layouts where Bootstrap falls short

### Responsive Design (Mobile-First)
- Write base styles for small screens, then scale up with `min-width` media queries:
  ```css
  /* Base: mobile styles */
  .feature-card { flex-direction: column; }

  /* Tablet and up */
  @media (min-width: 768px) {
    .feature-card { flex-direction: row; }
  }
  ```
- Standard Bootstrap 5 breakpoints to follow:
  - `576px` (sm), `768px` (md), `992px` (lg), `1200px` (xl)
- Every page must be fully usable at 375px width (smallest common mobile)

### Performance
- Use `transition` only on specific properties, never on `all`:
  ```css
  /* Good */
  transition: background-color 0.2s ease;

  /* Avoid */
  transition: all 0.3s ease;
  ```
- Avoid complex `@keyframes` animations — keep them purposeful and simple
- Minimize use of `@import` inside CSS — link all stylesheets directly in HTML

### Bootstrap Overrides
Never modify Bootstrap's CDN source. Override in `style.css` after the Bootstrap `<link>`:
```css
/* Override Bootstrap primary button with HandaPH orange */
.btn-primary {
  background-color: var(--color-secondary);
  border-color: var(--color-secondary);
  color: #fff;
}
.btn-primary:hover {
  background-color: #c2440a;
  border-color: #c2440a;
}
```

---

## JavaScript Best Practices

### Code Quality
- Always use `'use strict';` at the top of every `.js` file
- Use `const` by default. Use `let` only when the value will change. Never use `var`:
  ```js
  'use strict';
  const resultPanel = document.getElementById('result-panel');
  let currentStep = 1;
  ```
- Use descriptive camelCase names: `generateChecklist()`, `userSelections`, not `gc()` or `x`
- Every function should do one thing only (Single Responsibility)
- Keep functions short — if a function exceeds ~20 lines, split it

### DOM Manipulation
- Cache DOM selections in `const` variables — never query the DOM repeatedly inside loops:
  ```js
  // Good — query once, reuse the reference
  const resultPanel = document.getElementById('result-panel');
  resultPanel.classList.add('visible');

  // Avoid — querying inside a loop is expensive
  for (let i = 0; i < items.length; i++) {
    document.getElementById('result-panel').style.display = 'block';
  }
  ```
- Use `addEventListener` for all events — never use inline `onclick=""` in HTML:
  ```js
  // Good
  document.getElementById('next-btn').addEventListener('click', goToNextStep);

  // Avoid in HTML
  // <button onclick="goToNextStep()">
  ```
- Use `classList.add()`, `.remove()`, `.toggle()` to manage CSS classes — not `element.style` directly
- Use `textContent` for plain text. Use `innerHTML` only for actual HTML markup — and only with sanitized data

### Security (Critical)
- **Never trust user input.** Any data entered by a user and displayed back on screen must be sanitized:
  ```js
  // Safe — inserts plain text only, cannot execute scripts
  element.textContent = userInput;

  // Dangerous — never do this with raw user input
  element.innerHTML = userInput; // XSS vulnerability
  ```
- Never expose database credentials, admin passwords, or API keys in JavaScript files
- Do not store sensitive data in `localStorage` or `sessionStorage`

### Forms & Validation
- Always validate form inputs on the client side before submission (for UX):
  ```js
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validateForm()) return;
    submitForm();
  });
  ```
- Show clear error messages next to the invalid field — not browser `alert()` popups
- **Important:** Client-side validation is for UX only. PHP must also validate all submitted data

### Script Loading
- Load all `<script>` tags at the bottom of `<body>`, just before `</body>`:
  ```html
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/checklist.js"></script>
  </body>
  ```
- Or use the `defer` attribute when linking scripts in `<head>`:
  ```html
  <script src="./assets/js/main.js" defer></script>
  ```

### JS File Organization
One JS file per feature:
- `checklist.js` — 4-step questionnaire logic and rule engine
- `gobag.js` — Go-Bag tab filtering
- `feedback.js` — feedback form handling and star rating
- `admin-charts.js` — Chart.js dashboard visualizations

---

## Bootstrap 5 Best Practices

### CDN Links (Always use these exact versions)
```html
<!-- In <head> — CSS first -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Before </body> — JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

### Grid System Rules
- Always wrap content in the full hierarchy: `.container` → `.row` → `.col-*`
- Use responsive column classes: `col-12 col-md-6 col-lg-4`
- Never nest `.container` inside `.container`

### Using Bootstrap Components
- Use `navbar` for site navigation
- Use `card` for content containers (feature cards, checklist result, Go-Bag items)
- Use `modal` for the admin login overlay
- Use `tab` (via `nav-tabs` or `nav-pills`) for Before/During/After and Essentials/Recommended/Optional sections
- Use `carousel` for the Go-Bag guide slideshow
- Use `collapse` or `accordion` for the Myth-Busting section

### Bootstrap Utility Classes
Use Bootstrap utilities for minor adjustments instead of writing custom CSS:
```html
<!-- Spacing, alignment, display -->
<div class="d-flex align-items-center justify-content-between mt-3 mb-4 px-2">
```
Write custom CSS only for brand-specific styles that Bootstrap utilities cannot cover.

---

## Security Practices (Full Stack)

### Front-End (HTML/CSS/JS)
- Sanitize any user-generated content before inserting into the DOM
- Never expose credentials or sensitive data in client-side files
- Use HTTPS links for all external CDN resources (all CDN links above already use HTTPS)

### Back-End (PHP + MySQL)
- Validate and sanitize **all** user-submitted data on the PHP side, regardless of JS validation
- Use PDO prepared statements for all database queries — never concatenate user input into SQL:
  ```php
  // Good — prepared statement (prevents SQL injection)
  $stmt = $pdo->prepare("SELECT * FROM feedback WHERE location = ?");
  $stmt->execute([$location]);

  // Dangerous — never do this
  $query = "SELECT * FROM feedback WHERE location = '" . $location . "'";
  ```
- Use `password_hash()` and `password_verify()` for admin passwords — never store plain text
- Use PHP sessions for admin authentication — destroy the session on logout:
  ```php
  session_start();
  session_destroy(); // on logout
  ```
- Never display raw PHP error messages to users — log errors to a file instead

---

## Design System Rules

### Color Usage
| Color | Hex | Usage |
|---|---|---|
| Slate Navy | `#1E293B` | Headers, footer, navbar, admin sidebar |
| Safety Orange | `#EA580C` | All CTA buttons, primary actions |
| Soft White | `#F8FAFC` | Page backgrounds |
| Emergency Red | `#DC2626` | **Important Reminder boxes only** — nowhere else |
| Dark Gray (text) | `#1E293B` | Body text |
| Muted Gray | `#64748B` | Subtext, captions |

### Typography Rules
- Primary font: Inter or Roboto (Google Fonts)
- Headings: Bold, Slate Navy
- Body text: Dark Gray on Soft White
- Minimum font size: 16px for body text (never below 14px for any visible text)

### Component Consistency
- All CTA buttons use the `.btn-primary` class (overridden to Safety Orange)
- The Emergency Red `#DC2626` is used **exclusively** for the "Important Reminder" section on the Checklist results page
- Admin sidebar background: Slate Navy `#1E293B`
- Admin content area background: Soft White `#F8FAFC`

---

## VSCode Recommended Extensions
- **Prettier** — automatic code formatting (enable "Format on Save" in settings)
- **Live Server** — instant browser preview for HTML/CSS/JS without needing XAMPP
- **HTML CSS Support** — class name autocomplete from your stylesheet
- **Auto Rename Tag** — automatically renames the closing tag when you edit the opening tag
- **Path Intellisense** — autocompletes file paths in `href` and `src` attributes

---

## Topics Covered in Class (Reference)
The following HTML, CSS, JavaScript, and Bootstrap topics are part of the course curriculum and should be demonstrated in the implementation where applicable:

**HTML:** Document structure, semantic elements, attributes (href, src, alt, title), headings and paragraphs, formatting, lists, images, links, file paths, navigation bars, layout elements, block and inline elements, comments, accessibility basics.

**CSS:** Syntax and selectors, external CSS, colors, fonts, box model, navigation bar styling, Flexbox and Grid layout, media queries, responsive design, CSS units, display and position.

**JavaScript:** Variables, events, HTML DOM manipulation, forms and validation.

**Bootstrap:** Containers, grid system, buttons, cards, navbar, modal, utility classes.
