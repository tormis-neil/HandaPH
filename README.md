# HandaPH — Typhoon Preparedness System

HandaPH is a personalized typhoon preparedness web application designed to help Filipino families build their Go-Bags and actionable emergency plans before, during, and after a storm. By taking into account household size, location, and specific needs, it aims to reduce last-minute panic and save lives.

## Features

- **Personalized Checklist Generator**: Automatically generates tasks for "Before", "During", and "After" the storm based on your specific household setup.
- **Go-Bag Guide**: Outlines "Essentials", "Recommended" items, and budget-friendly alternatives to help everyone pack smartly.
- **Myth-Busting Section**: Corrects common and dangerous misconceptions regarding typhoon safety.
- **Comprehensive Admin Dashboard**:
  - Secure login and authentication.
  - CRUD operations for Go-Bag Items, Checklist Rules, and Typhoon Myths.
  - Analytics and Feedback viewing to monitor user submissions.

## Tools & Technologies Needed

To run this website locally, ensure you have the following installed:
- **PHP** (8.2 or higher, ideally 8.5+ as used in development)
- **Composer** (Dependency manager for PHP)
- **Node.js & NPM** (For frontend asset bundling)
- **MySQL** (via XAMPP, WAMP, Docker, or native installation)
- **Git** (For version control)

## Setup & Configuration Commands

1. **Clone the repository:**
   ```bash
   git clone <your-repository-url>
   cd HandaPH
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Configure Environment Variables:**
   ```bash
   cp .env.example .env
   ```
   Open the `.env` file and configure your database settings (e.g., `DB_DATABASE=handaph`).

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Run Database Migrations & Seeders:**
   Make sure your MySQL service is running, then execute:
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Local Development Server:**
   ```bash
   php artisan serve
   ```
   You can now access the application at `http://localhost:8000`.

## Troubleshooting Tips

- **Database Connection Refused:** Ensure your MySQL server (via XAMPP or Docker) is actively running on port 3306. Check your `.env` to verify `DB_HOST` and `DB_PORT` match your setup.
- **"Data truncated for column" Error in Admin Panel:** Ensure you have run `php artisan migrate`. If you previously had the old schema, run `php artisan migrate:fresh --seed` to completely refresh your database tables to match the current enum values.
- **Missing Pages / 404 Errors:** If you recently pulled new routes, try clearing the route cache using `php artisan route:clear`.
- **Styling or Scripts Not Loading:** Run `npm run dev` or `npm run build` to ensure your Bootstrap and custom assets are correctly compiled.
