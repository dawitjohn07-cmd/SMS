# Student Management System (SMS)

Angular 20 frontend and Laravel 12 API implementing the supplied Figma Make student management prototype. The Northstar visual language and primary views are retained: administrator sign in, dashboard, student directory, enrollment and editing, student profile, activity log, and account settings. Student and activity data come from the API and SQLite/MySQL database.

## Requirements

- Windows 10/11 with PowerShell 5.1 or newer
- PHP 8.2+ with `pdo_sqlite`, `openssl`, `mbstring`, `fileinfo`, `tokenizer`, `xml`, and `ctype` extensions enabled
- Composer 2
- Node.js 20.19+ and npm

## Quick start (PowerShell)

Open two PowerShell windows in the extracted `student-management` folder.

### 1. Laravel API

```powershell
cd backend
Copy-Item .env.example .env
composer install
```

Edit `backend/.env` and set a private administrator password of at least 12 characters. Then run:

```powershell
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate --seed
php artisan serve
```

The API starts at `http://localhost:8000`. The seeded account uses `ADMIN_EMAIL` from `.env` (default `admin@northstar.edu`) and the `ADMIN_PASSWORD` you set. Change the password before exposing the app outside localhost. The seeder creates only one administrator; it does not create demo student records.

By default SQLite is used at `backend/database/database.sqlite`. To use MySQL instead, set `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`, create that database, then run `php artisan migrate --seed`.

### 2. Angular frontend

```powershell
cd frontend
npm install
npm start
```

Open `http://localhost:4200`. The frontend calls `http://localhost:8000/api` by default; change `base` in `frontend/src/app/core/api.service.ts` if your API uses another URL. `npm run build` creates a production build under `frontend/dist/northstar/browser`.

## API overview

The only public authentication route is `POST /api/login`. Google OAuth and password-recovery screens/endpoints are intentionally not part of this version. All other administrator routes require a Laravel Sanctum bearer token returned by login.

Protected routes include `GET /api/me`, `POST /api/logout`, `GET /api/dashboard`, CRUD at `/api/students`, `GET /api/activities`, `PUT /api/profile`, and `PUT /api/password`. The student collection accepts `search`, `status`, `course`, `sort` (`Newest`, `Name A–Z`, or `GPA high`), `page`, and `per_page` query parameters. Laravel validation errors are returned as JSON and surfaced in the Angular UI.

## Database and security

Run `php artisan migrate` after schema changes. `php artisan migrate:fresh --seed` recreates the database and removes all student records. Do not run this on data you need to keep. Sanctum bearer tokens are stored by the Angular app in browser local storage and protected endpoints require authentication. Use HTTPS, a strong unique admin password, and a restricted database account for deployment. `.env` and SQLite database files are excluded from source control.

## Verification notes

The supplied project was an Angular/Laravel application. Its administrator sign-in UI follows the supplied bright HTML reference. Login uses the Laravel API; the reference's simulated sign-in, Google OAuth, password recovery, and theme switch are not included. API/database execution requires Composer and PHP extensions on the target machine.
