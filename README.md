# HandaPH 🛡️

**Be Ready Before the Storm.**

HandaPH is a web-based, personalized typhoon preparedness system designed specifically for Filipino households. It helps families create their own action plan before, during, and after a storm based on their location, household size, special needs, and home structure.

## Overview & Current State

Currently, HandaPH is fully functional with a dynamic front-end. By answering a quick 4-question survey, users can generate a customized checklist tailored precisely for their living situation. No registration is required, making the tool instantly accessible to anyone rushing to prepare.

---

## How It Works: Project Files & Logic Explained

If you are curious about what makes this project tick, here is a quick guide to the main files and folders. You don't need coding experience to understand how HandaPH works!

### ✨ The Main Landing Page: `index.html`
* **What it does:** This is the "front door" of HandaPH. It introduces the project, breaks down common typhoon myths (like thinking a concrete house is automatically safe), and gently encourages users to start their own preparedness plan.
* **Why it's there:** We want users to understand *why* they need a plan before they start clicking buttons. It establishes trust and provides important statistics.
* **How it works:** It uses standard webpage structure (HTML) combined with clean styling (Bootstrap CSS) to make the text read easily on both mobile phones and laptops.

### 📝 Core Features: Inside the `pages/` Folder

The `pages/` directory holds the most important tools of the website. 

#### 1. `checklist.html` (The Plan Generator)
* **What it does:** This is the heart of HandaPH. It asks you four quick questions:
   1. Where you live (coastal, inland, flood-prone, etc.)
   2. How many people are in your household
   3. If you have any special needs (kids, seniors, pets, etc.)
   4. Your home's building material
* **Why it's there:** Generic checklists tell you to pack things you might not need while ignoring things you *do* need. This page ensures you get advice specific to you.
* **How it works:** Behind the scenes, JavaScript (the brain of the website) looks at your answers and uses "logic rules" to figure out what advice to give you. For example, if you say you have an infant, the system automatically adds "baby formula and diapers" to your list. It then displays your personalized Before, During, and After plan.

#### 2. `go-bag.html` (Emergency Kit Guide)
* **What it does:** A visual, tabbed guide for packing an emergency "Go-Bag" so you are ready to evacuate if needed.
* **Why it's there:** Knowing *what* to do is great, but having the physical supplies ready is essential. This page helps families buy and organize the right items on a budget.
* **How it works:** It separates items into "Essentials", "Recommended", and "Optional" tabs. This prevents users from feeling entirely overwhelmed by a massive list of items.

#### 3. `feedback.html` (Listening to Users)
* **What it does:** A simple page allowing users to give us a 1 to 5-star rating and write comments about what features they'd like to see next.
* **Why it's there:** We want HandaPH to grow based on real feedback from real Filipino families.
* **How it works:** It displays an interactive form where users can click stars and type their thoughts.

### 🔒 Behind the Scenes: The `admin/` Folder

While the `pages/` folder is for public users, the `admin/` folder is strictly for the staff managing HandaPH. Normal users do not see these pages.

#### 1. `login.html`
* **What it does:** Acts as the secure gateway to the admin tools.
* **Why it's there:** To ensure only authorized personnel can view sensitive survey analytics and manage site content.
* **How it works:** It provides a form requesting an email and password. It protects the sensitive files behind an authentication wall.

#### 2. `dashboard.html`
* **What it does:** Serves as a control center showing real-time statistics (like location types and household profiles of users).
* **Why it's there:** It allows staff to see *who* is using the platform and *what* their needs are, helping organizations understand community vulnerabilities.
* **How it works:** It uses interactive charts (via Chart.js) to visually map out the data gathered from the public survey checklists.

#### 3. `feedback-management.html`
* **What it does:** Displays all the suggestions and star ratings submitted by public users.
* **Why it's there:** Without reading user feedback, the tool can't evolve. This centralizes all reviews into one dashboard for the team to evaluate.
* **How it works:** It populates a structured table with the incoming data from the `feedback.html` public page.

#### 4. `checklist-items.html` & `preparedness-tips.html`
* **What it does:** Provides an interface to add, remove, or edit the advice given on the user checklists.
* **Why it's there:** So non-technical staff can update emergency protocols without needing a programmer to write new code for them.
* **How it works:** Similar to a management view, staff can type new instructions and save them to update the system.

#### 5. `admin-account.html`
* **What it does:** Allows the staff member to manage their own profile and settings.
* **Why it's there:** So individual team members can secure their accounts or update their contact info.
* **How it works:** Provides standard input forms for name, email, and password changes.

### 🎨 The Building Blocks: The `assets/` Folder

This folder holds the underlying resources that make the website look good and function properly.

#### The `css/` Folder (Styling)
* **What it does:** Dictates the visual appearance of the website.
* **Why it's there:** HTML builds the "skeleton" of the site. CSS provides the "skin" (colors, fonts, box sizes, and layouts).
* **How it works:** 
  * `style.css` ensures the main theme, fonts, and colors match universally across the site.
  * `admin.css` gives the admin dashboard its unique, professional sidebar layout.
  * `checklist.css` styles the specific progress bars and buttons in the survey.

#### The `img/` Folder (Images)
* **What it does:** Stores local image files.
* **Why it's there:** To keep all logos, background graphics, and icons organized in one safe place.
* **How it works:** The HTML pages point their image tags directly to the pictures stored in this directory.

#### The `js/` Folder (JavaScript / The Engine)
* **What it does:** Provides interactivity and logic to the website.
* **Why it's there:** A website without JavaScript is static. This folder makes buttons work, calculates rules, and creates dynamic content.
* **How it works:** 
  * `checklist.js`: The brain evaluating your survey answers and generating the customized plans.
  * `feedback.js`: Handles form validation before submitting user feedback.
  * `gobag.js`: Makes the layout and tabs on the Go-Bag page smoothly switch without reloading.
  * `admin-charts.js` & `admin-nav.js`: Draws the visual graphs on the dashboard and handles the admin sidebar on mobile phones.

---

*Stay safe, and don't wait for the warning signal to build your family's plan today!*
