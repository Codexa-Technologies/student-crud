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

- PHP 8.2+ and Composer
- MySQL 8+ or MariaDB 10.4+ (or compatible)
- Node.js 18+ (optional, for Vite/asset building)

## Installation

Run the following commands from the project root to set up the application.

```powershell
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate the application key
php artisan key:generate

# Run migrations and seed demo data
php artisan migrate --seed

# Start the local development server
php artisan serve
```

Then visit: http://127.0.0.1:8000/students

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
