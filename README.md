## Database Configuration
Update your database credentials in the `.env` file before migrating:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
- Create the database (`your_database_name`) in MySQL/MariaDB.
- Ensure the user has privileges to create tables and insert data.
- If you change connection details, run `php artisan config:clear` to reload config.
<h1 align="center">Laravel Student CRUD</h1>

A simple, professional starter for managing student records with full CRUD (create, read, update, delete) using Laravel's resource controllers, Eloquent models, Blade views, and database seeders.

**Student list is available at** `/students` via the resource route defined in [routes/web.php](routes/web.php).

## Project Overview

- Add, edit, view, and delete students
- Resourceful routes via `Route::resource('students', StudentController::class)`
- Eloquent model `Student` with migrations and seeders
- Blade views under [resources/views/students](resources/views/students) for a clean UI
- Ready-to-run local development with seeding for demo data

## Requirements

# Laravel Student CRUD

A simple, professional starter for managing student records with full CRUD (create, read, update, delete) using Laravel resource controllers, Eloquent models, Blade views, and database seeders.

**Student list is available at** `/students` via the resource route defined in [routes/web.php](routes/web.php).

## Project Overview

- Add, edit, view, and delete students
- Resourceful routes via `Route::resource('students', StudentController::class)`
- Eloquent model `Student` with migrations and seeders
- Blade views under [resources/views/students](resources/views/students) for a clean UI
- Ready-to-run local development with seeding for demo data

## Requirements

- PHP 8.2+ and Composer
- MySQL 8+ or MariaDB 10.4+ (or compatible)
- Node.js 18+ (optional, for Vite/asset building)

## Installation & Quick Start

Run the commands below from the project root to set up and run the application locally.

1) Install PHP deps and prepare env

```bash
composer install
# Windows PowerShell: copy .env.example .env
# Unix / macOS: cp .env.example .env
php artisan key:generate
```

2) Create DB and run migrations + seed (recommended)

```bash
# create your database in MySQL first, then:
php artisan migrate:fresh --seed
```

3) (Optional) Frontend tooling & asset build

```bash
npm install
npm run dev       # development
npm run build     # production
```

4) (Optional) Install Laravel Breeze (auth)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
php artisan migrate
```

5) Serve the app locally

```bash
php artisan serve
# visit http://127.0.0.1:8000/students
```

## How to Run

- Start the server: `php artisan serve`
- Open your browser at: `http://127.0.0.1:8000`
- Navigate to the student module: `http://127.0.0.1:8000/students`

## Project Structure (key files)

- Routing: [routes/web.php](routes/web.php)
- Controller: `app/Http/Controllers/StudentController.php`
- Model: [app/Models/Student.php](app/Models/Student.php)
- Views: [resources/views/students](resources/views/students)
- Migrations: [database/migrations](database/migrations)
- Seeders: [database/seeders](database/seeders)

## Troubleshooting

- Env not loading: run `php artisan config:clear`
- Fresh start: `php artisan migrate:fresh --seed` to rebuild tables with demo data
- Port busy: change the serve port with `php artisan serve --port=8001`

## Notes

- This project uses Laravel's resource routing; all CRUD endpoints are under `/students`.
- For asset building (if used), run `npm install` and `npm run dev`.
