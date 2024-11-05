
# Moduler based admin panel boilerplate 

This project is built with Laravel, Vue.js, and Inertia.js, providing a streamlined single-page application experience with support for image manipulation, Excel imports, job queue processing, and authentication.

---

## Table of Contents
- [Moduler based admin panel boilerplate](#moduler-based-admin-panel-boilerplate)
  - [Table of Contents](#table-of-contents)
  - [Requirements](#requirements)
  - [Installation](#installation)
  - [Frontend Setup (Vue.js)](#frontend-setup-vuejs)
  - [Inertia.js Setup](#inertiajs-setup)
  - [Packages and Dependencies](#packages-and-dependencies)
  - [Queue Job Setup](#queue-job-setup)
  - [Usage](#usage)

---

## Requirements
- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL (or other supported database)
- Redis (optional, for enhanced queue management)

---

## Installation

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Environment Setup**:
   Copy the example environment file and configure database and other environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**:
   Run migrations to set up the database tables:
   ```bash
   php artisan migrate
   ```

---

## Frontend Setup (Vue.js)

1. **Install Laravel UI**:
   ```bash
   composer require laravel/ui
   ```

2. **Generate Vue Scaffolding**:
   ```bash
   php artisan ui vue
   ```

3. **Install JavaScript Dependencies**:
   ```bash
   npm install
   npm run dev
   ```

---

## Inertia.js Setup

1. **Install Inertia Laravel Adapter**:
   ```bash
   composer require inertiajs/inertia-laravel
   ```

2. **Install Inertia Middleware**:
   ```bash
   php artisan inertia:middleware
   ```

3. **Configure Inertia in `resources/views/app.blade.php`**:

   ```html
   <head>
       @vite('resources/js/app.js')
       @inertiaHead
   </head>
   <body>
       @inertia
   </body>
   ```

4. **Middleware Registration**:
   Register `HandleInertiaRequests` in `app/Http/Kernel.php` under `web` middleware group.

---

## Packages and Dependencies

Install additional packages required for this project:

```bash
composer require maatwebsite/excel:^3.1
composer require intervention/image
composer require inertiajs/inertia-laravel
composer require laravel/passport
```

---

## Queue Job Setup

1. **Create Jobs Table**:
   ```bash
   php artisan queue:table
   ```

2. **Set Queue Connection**:
   Set `QUEUE_CONNECTION=database` in your `.env` file.

3. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

4. **Start Queue Worker**:
   To start processing jobs, use the following command:
   ```bash
   php artisan queue:work
   ```

---

## Usage

- **Excel Import**: Use `maatwebsite/excel` for importing Excel files.
- **Image Manipulation**: Use `Intervention Image` for resizing, cropping, and other image transformations.
- **Authentication**: Use Laravel Passport for API authentication.
