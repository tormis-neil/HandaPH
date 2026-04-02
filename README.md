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

While the `pages/` folder is for public users, the `admin/` folder is strictly for the staff managing HandaPH. 
* **`login.html`**: The secure gateway. Only authorized staff with an email and password can get past this screen.
* **`dashboard.html`**: A control center that uses interactive graphics to show statistics on how many people are using the site, what kind of houses they have, and their general needs.
* **`feedback-management.html`**: Where the staff can read the suggestions and ratings sent by users through the public feedback form.
* **`checklist-items.html` & `preparedness-tips.html`**: Interfaces that allow staff to easily manage and update the advice given to users.
* **`admin-account.html`**: Profile and settings management for the staff member currently logged in.

### 🎨 The Building Blocks: The `assets/` Folder

This folder holds the underlying resources that make the website look good and function properly.
* **`css/` (Styling):** This is where the colors, fonts, and layout instructions live. For example, `style.css` handles the main look across the site, while `admin.css` gives the admin dashboard its unique professional layout.
* **`img/` (Images):** Any logos, icons, or custom illustrations used across the site are stored here.
* **`js/` (JavaScript / The Engine):** These files are the invisible brain of the website. For instance, `checklist.js` evaluates your survey answers to create your customized plan, `feedback.js` handles form entries securely, and `admin-charts.js` draws the visual statistics on the staff dashboard.

---

*Stay safe, and don't wait for the warning signal to build your family's plan today!*
