<h1 align="center">Laravel Student Management System</h1>

A comprehensive student management system built with Laravel featuring full CRUD operations, user authentication, course management, and a modern responsive design.

**Student management is available at** `/students` via the resource route defined in [routes/web.php](routes/web.php).

## Features

- **Student Management**: Add, edit, view, and delete student records
- **Course Management**: Manage courses and assign students to courses
- **User Authentication**: Secure login and registration system using Laravel Breeze
- **Modern UI**: Clean, responsive design with solid colors and professional styling
- **Search & Filter**: Real-time search functionality for students
- **Data Validation**: Comprehensive form validation and error handling
- **Database Seeding**: Pre-populated demo data for testing
- **Responsive Design**: Mobile-friendly interface that works on all devices

## Project Overview

- Full CRUD operations for students and courses
- Resourceful routes via `Route::resource('students', StudentController::class)`
- Eloquent models with relationships (Student belongs to Course)
- Clean Blade views with modern styling
- User authentication and authorization
- Database migrations and seeders for easy setup
- Real-time search with AJAX functionality

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

- Create the database (`your_database_name`) in MySQL.
- Ensure the user has privileges to create tables and insert data.
- If you change connection details, run `php artisan config:clear` to reload config.

## How to Run

- Start the server: `php artisan serve`
- Open your browser at: `http://127.0.0.1:8000`
- Register a new account or login with existing credentials
- Navigate to the student management: `http://127.0.0.1:8000/students`
- Access course management: `http://127.0.0.1:8000/courses`

## Project Structure (key files)

- **Authentication**: Laravel Breeze for login/register functionality
- **Routing**: [routes/web.php](routes/web.php) - All application routes
- **Controllers**: 
  - `app/Http/Controllers/StudentController.php` - Student CRUD operations
  - `app/Http/Controllers/CourseController.php` - Course management
- **Models**: 
  - [app/Models/Student.php](app/Models/Student.php) - Student model with course relationship
  - [app/Models/Course.php](app/Models/Course.php) - Course model
- **Views**: 
  - [resources/views/students](resources/views/students) - Student management pages
  - [resources/views/courses](resources/views/courses) - Course management pages
  - [resources/views/auth](resources/views/auth) - Authentication pages
  - [resources/views/layouts](resources/views/layouts) - Layout templates
- **Database**: 
  - [database/migrations](database/migrations) - Database structure
  - [database/seeders](database/seeders) - Sample data generation

## Troubleshooting

- Env not loading: run `php artisan config:clear`
- Fresh start: `php artisan migrate:fresh --seed` to rebuild tables with demo data
- Port busy: change the serve port with `php artisan serve --port=8001`

## Notes

- This project uses Laravel's resource routing for both students and courses
- Authentication is handled by Laravel Breeze
- Modern, responsive design with clean solid colors
- Real-time search functionality with debounced input
- Form validation with user-friendly error messages
- Database relationships: Students belong to Courses
- For asset building (if used), run `npm install` and `npm run dev`

## Screenshots

The application features:
- Clean login/register pages with centered forms
- Modern student listing with search and pagination
- Intuitive create/edit forms with validation
- Responsive design that works on mobile devices
- Professional color scheme with solid colors throughout