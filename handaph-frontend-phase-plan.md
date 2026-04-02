# HandaPH — Front-End Phase Plan

## Project Context
- **Project:** HandaPH — A Personalized Typhoon Preparedness Web System
- **Developer:** Solo (Lead Front-End Developer)
- **Front-End Deadline:** After Holy Week (target: April 21, 2026)
- **Tech Stack:** HTML5, CSS3, Bootstrap 5, Vanilla JavaScript, PHP, MySQL, Chart.js
- **Editor:** VSCode + XAMPP
- **Design System:** Slate Navy `#1E293B` / Safety Orange `#EA580C` / Soft White `#F8FAFC` / Emergency Red `#DC2626` (reminders only)

---

## Pages to Build

| Page | File | Type |
|---|---|---|
| Home | `index.html` | Public |
| Checklist (4-step form + results) | `pages/checklist.html` | Public |
| Go-Bag Guide | `pages/go-bag.html` | Public |
| Feedback | `pages/feedback.html` | Public |
| Admin Login | `admin/login.html` | Admin |
| Admin Dashboard (Analytics) | `admin/dashboard.html` | Admin |
| Admin Feedback Management | `admin/feedback-management.html` | Admin |
| Admin Checklist Items CMS | `admin/checklist-items.html` | Admin |
| Admin Preparedness Tips CMS | `admin/preparedness-tips.html` | Admin |

---

## Phase 1 — Setup & Design Foundation
**Target dates: Mar 24 – Mar 28**
**Status: [ ] Not Started**

### Tasks
- [ ] Create project folder structure:
  ```
  /handaph
    /assets/css/style.css
    /assets/js/
    /assets/img/
    /admin/
    /pages/
    index.html
  ```
- [ ] Create `style.css` — define all CSS custom properties (`:root` variables) for the full color system, spacing, and border radius
- [ ] Build shared public layout template (base HTML with `<head>`, navbar, footer placeholder)
  - Navbar: HandaPH logo (left) + links: Home / Checklist / Go-Bag / Feedback (right)
  - Footer: HandaPH branding, Quick Links, Resources, disclaimer ("Not affiliated with any government agency"), copyright line
- [ ] Import Bootstrap 5 CDN (CSS in `<head>`, JS bundle before `</body>`)
- [ ] Import Inter or Roboto from Google Fonts
- [ ] Build admin layout template (separate — dark Slate Navy sidebar + main content area, no public navbar/footer)
  - Sidebar links: Analytics, Feedback Management, Checklist Items, Preparedness Tips, Sign Out

### Goal
Every subsequent page will extend these two templates. Build once, reuse everywhere. No page should have inconsistent fonts, colors, or navbar structure.

---

## Phase 2 — Home Page
**Target dates: Mar 29 – Apr 1**
**Status: [ ] Not Started**
**File:** `index.html`

### Tasks
- [ ] **Hero Section**
  - Headline: "Be Ready Before the Storm"
  - Subtext: brief description of HandaPH
  - CTA button (Safety Orange, `.btn-primary`): "Generate Your Plan" → links to `pages/checklist.html`
  - Hero image/illustration placeholder (right side on desktop, stacked on mobile)

- [ ] **Feature Cards Section**
  - Section heading: "Everything You Need to Prepare"
  - 4 Bootstrap `card` components in a responsive grid (`col-12 col-md-6 col-lg-3`):
    1. Personalized Checklist — icon + description
    2. Go-Bag Guide — icon + description
    3. Share Feedback — icon + description
    4. Download Resources — icon + description

- [ ] **Myth-Busting Section**
  - Section heading: "Common Typhoon Myths"
  - 3–5 interactive Bootstrap `accordion` or `collapse` items
  - Each item: myth statement (collapsed) → correction/fact (expanded)
  - Use Emergency Red `#DC2626` sparingly for myth labels only

### Notes
- Myth-Busting uses Bootstrap's built-in `accordion` component — no custom JS needed
- Mobile layout: all sections stack vertically. Hero image hides on small screens if needed

---

## Phase 3 — Checklist Page (Core Feature)
**Target dates: Apr 2 – Apr 8**
**Status: [ ] Not Started**
**File:** `pages/checklist.html`

### Tasks
- [ ] **4-Step Questionnaire UI**
  - Progress indicator: "Question X of 4"
  - Each step shows in a Bootstrap `card` container
  - Options displayed as large pill/button selectors (not radio inputs) — selected state uses Slate Navy fill
  - Back and Next navigation buttons; final step shows "Generate Checklist" button

- [ ] **Step 1 — Location Type**
  - Question: "What type of area do you live in?"
  - Options: Coastal Area / Mountainous Area / Inland or Urban Area / Flood-Prone Area

- [ ] **Step 2 — Household Size**
  - Question: "How many people live in your household?"
  - Options: 1 Person / 2–4 People / 5–7 People / 8 or more

- [ ] **Step 3 — Special Household Members**
  - Question: "Does your household include any of the following?"
  - Options (multi-select): Children (0–12 years) / Senior Citizens (60+) / Persons with Disabilities / Pets
  - User can select multiple options — selected state toggles on/off

- [ ] **Step 4 — House Material**
  - Question: "What is your house mainly made of?"
  - Options: Light Materials / Semi-Concrete / Concrete

- [ ] **Results Section** (shown after "Generate Checklist" is clicked)
  - "Your Personalized Checklist" heading
  - "Based on your household details, here's what you need to prepare" subtext
  - **Important Reminder box** (Emergency Red `#DC2626` accent): "Always follow official advisories from PAGASA, NDRRMC, and local government units."
  - Download Checklist button (Slate Navy) + Start Over button (outlined)
  - Bootstrap `nav-tabs` or `nav-pills`: **Before** / **During** / **After**
  - Tab content area: displays preparedness checklist items for the selected phase
  - "How was your experience?" section with Feedback button → links to `pages/feedback.html`

- [ ] **JavaScript Rule Engine** *(stretch goal — implement if time permits before deadline)*
  - File: `assets/js/checklist.js`
  - Store user selections from all 4 steps in a `const userSelections` object
  - Build a `rules.js` data structure mapping input combinations to checklist items
  - On "Generate Checklist": filter rules based on selections, render items into the Before/During/After tab panels dynamically
  - If NOT implementing JS logic: populate tab panels with static, representative placeholder content

### Notes
- This is the most complex page. Allocate the most time here
- Build the full UI first with static content, then layer in JS logic if time allows
- Step navigation is handled with JS — only one step card is visible at a time (show/hide using `classList`)

---

## Phase 3b — Go-Bag Page
**Target dates: Apr 9 – Apr 11**
**Status: [ ] Not Started**
**File:** `pages/go-bag.html`

### Tasks
- [ ] **Header**
  - Heading: "Emergency Go-Bag Guide"
  - Subtext: "A Go Bag contains survival essentials you need when you have to evacuate quickly. It should be packed and ready at all times."

- [ ] **Bootstrap Carousel (Slideshow)**
  - 3 slides with Go-Bag guide categories:
    1. General Tips — your emergency evacuation kit essentials
    2. Special Needs — items for children, seniors, PWDs
    3. Budget Alternatives — DIY and low-cost options
  - Left/right arrow controls, dot indicators at bottom

- [ ] **Download Complete Guide button** (Slate Navy, right-aligned)

- [ ] **Item Tabs**
  - Bootstrap `nav-pills`: **Essentials** / **Recommended** / **Optional**
  - **Essentials tab:** Water (1 liter/person/day for 3 days), Non-perishable food, Medications and first aid kit, Important documents (copies), Flashlight and batteries, Whistle
  - **Recommended tab:** Power bank, Change of clothes, Extra cash, Battery-powered radio
  - **Optional tab:** DIY waterproof pouches, Recycled containers for water, Extra comfort items
  - Each tab content area: responsive item list or card grid

- [ ] **Feedback CTA**
  - "How was your experience?" section
  - Feedback button → links to `pages/feedback.html`

---

## Phase 4 — Feedback Page
**Target dates: Apr 12 – Apr 13**
**Status: [ ] Not Started**
**File:** `pages/feedback.html`

### Tasks
- [ ] **Header**
  - Heading: "Share Your Feedback"
  - Subtext: "Help us improve this resource"

- [ ] **Feedback Form** (inside a rounded Bootstrap `card`)
  - Q1: Star rating (1–5) — custom interactive star widget using JS `classList` toggle
  - Q2: Radio group — "Was the checklist easy to understand?" (Yes, very easy / Somewhat / Confusing)
  - Q3: Radio group — "Did the checklist help you identify what to prepare?" (Yes, very helpful / Somewhat helpful / No, not really)
  - Q4: Textarea — "What would you like to improve?" (optional, placeholder text)
  - Q5: Dropdown — "Share your general location" (Select province/region — list all PH provinces)
  - Submit button (Safety Orange)

- [ ] **Success State**
  - On submit (before PHP is wired): show an inline success message "Thank you for your feedback!" using JS
  - File: `assets/js/feedback.js`

### Notes
- Form submits to a PHP file during the backend phase — for now, JS prevents default and shows the success message
- The location dropdown does not collect personally identifiable information — it is anonymous and province-level only

---

## Phase 5 — Admin Section
**Target dates: Apr 14 – Apr 18**
**Status: [ ] Not Started**

### Phase 5a — Admin Login
**File:** `admin/login.html`

- [ ] Centered card layout (no sidebar on this page)
- [ ] Email input + Password input
- [ ] Login button (Safety Orange)
- [ ] "I forgot my password" link below the button
- [ ] HandaPH logo above the card

### Phase 5b — Admin Dashboard (Analytics)
**File:** `admin/dashboard.html`

- [ ] Admin layout: Slate Navy sidebar + main content
- [ ] Top stat row: 3 counter cards — Queries / Feedback / Tip Sets (numbers, Slate Navy accent)
- [ ] Section heading: "Analytics — Manage your platform content"
- [ ] 4 Chart.js visualizations in a 2×2 responsive grid:
  1. **Location Type Distribution** — area/line chart
  2. **Household Size Distribution** — donut/pie chart
  3. **Special Household Needs** — bar chart (stacked or grouped)
  4. **House Type Distribution** — horizontal bar chart
- [ ] File: `assets/js/admin-charts.js` — initialize all 4 charts with sample/placeholder data

### Phase 5c — Feedback Management
**File:** `admin/feedback-management.html`

- [ ] Section heading + stat counters (same pattern as dashboard)
- [ ] Filter controls: "All Ratings" dropdown + "All Locations" dropdown + search/filter button
- [ ] User Feedback table: columns for Rating, Location, Date — empty state message: "No Feedback Submissions Yet"
- [ ] Comments section below: empty state message: "No Comments Yet"

### Phase 5d — Checklist Items CMS
**File:** `admin/checklist-items.html`

- [ ] Section heading + stat counters
- [ ] "Add Item" button (Safety Orange) — opens an inline form or modal
- [ ] Add/Edit form fields:
  - Item Name (text input)
  - Category dropdown (Food & Water, Documents, Medical, Tools, Clothing, Others)
  - Description (textarea, optional)
  - Budget-Friendly Alternative (textarea, optional)
  - Cancel + Save buttons
- [ ] Items table below the form: Item Name, Category, Actions (Edit / Delete)

### Phase 5e — Preparedness Tips CMS
**File:** `admin/preparedness-tips.html`

- [ ] Section heading + stat counters
- [ ] "Add Tip" button (Safety Orange)
- [ ] Add/Edit form fields:
  - Tip Title (text input)
  - Tip Content (textarea)
  - Tag dropdown (Before / During / After)
  - ID (auto or manual)
  - Cancel + Save buttons
- [ ] Tips table: Tip Title, Tag, Actions (Edit / Delete)

---

## Phase 6 — Polish, PDF Export & Final QA
**Target dates: Apr 19 – Apr 21**
**Status: [ ] Not Started**

### Tasks
- [ ] **Mobile Responsiveness Audit** — test all pages at these widths:
  - 375px (iPhone SE — smallest target)
  - 390px (iPhone 14)
  - 768px (iPad / tablet)
  - 1280px (laptop)

- [ ] **Download Checklist Feature** — implement as print-friendly CSS:
  ```css
  @media print {
    .navbar, .footer, .questionnaire-form, .feedback-cta { display: none; }
    .checklist-results { display: block !important; }
  }
  ```
  The browser's "Print to PDF" becomes the download — no third-party library needed, works offline.

- [ ] **Cross-Browser Testing**
  - Chrome (primary)
  - Firefox
  - Mobile Safari (iOS)

- [ ] **Final Design Consistency Check**
  - Emergency Red `#DC2626` appears only in the "Important Reminder" box
  - All CTA buttons are Safety Orange
  - Heading hierarchy is correct on every page (one `<h1>` per page)
  - All images have `alt` attributes
  - All form inputs have associated `<label>` elements

- [ ] **Code Cleanup**
  - Remove all commented-out dead code
  - Remove all `console.log()` debug statements from JS files
  - Validate all HTML pages at [validator.w3.org](https://validator.w3.org)
  - Check CSS for unused rules

---

## JS Rule Engine Reference (Checklist Logic)
*(Stretch goal — implement during Phase 3 if time allows)*

The rule engine maps user selections to specific checklist items. Each item has tags matching the 4 input dimensions:

```js
'use strict';

const checklistRules = [
  {
    item: "Store at least 3 liters of water per person per day for 3 days",
    phases: ["before"],
    locations: ["coastal", "mountainous", "inland", "flood-prone"], // all
    sizes: ["1", "2-4", "5-7", "8-plus"],                           // all
    specialNeeds: [],   // empty = applies to all
    houseTypes: []      // empty = applies to all
  },
  {
    item: "Prepare sandbags to block doorways",
    phases: ["before"],
    locations: ["flood-prone", "coastal"],
    sizes: [],
    specialNeeds: [],
    houseTypes: ["light", "semi-concrete"]
  },
  {
    item: "Prepare infant formula, diapers, and baby medicines",
    phases: ["before"],
    locations: [],
    sizes: [],
    specialNeeds: ["children"],
    houseTypes: []
  }
  // Add more rules following this pattern...
];

// Filter rules based on user selections and render to the DOM
function generateChecklist(userSelections) {
  const filtered = checklistRules.filter(rule => {
    const locMatch = rule.locations.length === 0 || rule.locations.includes(userSelections.location);
    const sizeMatch = rule.sizes.length === 0 || rule.sizes.includes(userSelections.size);
    const needsMatch = rule.specialNeeds.length === 0 ||
      rule.specialNeeds.some(n => userSelections.specialNeeds.includes(n));
    const houseMatch = rule.houseTypes.length === 0 || rule.houseTypes.includes(userSelections.houseType);
    return locMatch && sizeMatch && needsMatch && houseMatch;
  });

  renderByPhase(filtered, 'before');
  renderByPhase(filtered, 'during');
  renderByPhase(filtered, 'after');
}

function renderByPhase(rules, phase) {
  const panel = document.getElementById(`panel-${phase}`);
  const items = rules.filter(r => r.phases.includes(phase));
  panel.innerHTML = items.map(i => `<li class="checklist-item">${i.item}</li>`).join('');
}
```

---

## Progress Tracker

| Phase | Description | Target | Status |
|---|---|---|---|
| Phase 1 | Setup & Design Foundation | Mar 24–28 | [ ] Not Started |
| Phase 2 | Home Page | Mar 29–Apr 1 | [ ] Not Started |
| Phase 3 | Checklist Page | Apr 2–8 | [ ] Not Started |
| Phase 3b | Go-Bag Page | Apr 9–11 | [ ] Not Started |
| Phase 4 | Feedback Page | Apr 12–13 | [ ] Not Started |
| Phase 5 | Admin Section | Apr 14–18 | [ ] Not Started |
| Phase 6 | Polish & Final QA | Apr 19–21 | [ ] Not Started |

Update each phase status to `[ ] In Progress` → `[x] Done` as you complete them.
