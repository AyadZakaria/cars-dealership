# Car Dealership Management System

A web application for managing a car dealership, built with [Laravel](https://laravel.com/). This system allows administrators to manage cars, customers, users, and reservations through a user-friendly interface.

## Features

- Car inventory management (add, edit, delete, view cars)
- Customer management
- User management with roles (admin, guest)
- Reservation management (create, edit, delete, view reservations)
- Admin dashboard
- Authentication and authorization
- Responsive UI with Blade templates and Tailwind CSS

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or compatible database

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/cars-dealership.git
   cd cars-dealership
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Copy the example environment file and configure:**
   ```bash
   cp .env.example .env
   ```
   - Update `.env` with your database and mail settings.

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

7. **Build frontend assets:**
   ```bash
   npm run build
   ```
   - For development, you can use `npm run dev` to watch for changes.

8. **Start the local development server:**
   ```bash
   php artisan serve
   ```
   - The app will be available at [http://localhost:8000](http://localhost:8000).

## Default Admin Login

If seeders create a default admin user, use these credentials (update if different):

- **Email:** admin@example.com
- **Password:** password

Otherwise, register a new user and assign admin privileges manually.

## Running Tests

To run the test suite:
```bash
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
