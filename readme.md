# Running Two Laravel Projects with Scheduler

Functionality Description: Syncing Categories Between Two Projects
This functionality ensures that categories from one project are synchronized and pushed to another project.

This guide explains how to set up and run two Laravel projects, along with configuring a scheduler to run scheduled tasks.

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP
- Composer
- MySQL or another database server
- Web server (e.g., Apache, Nginx)

## Project Setup

### Project 1

2. Navigate to the project directory:

   ```bash
   cd project1
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the database connection in the `.env` file.

7. Migrate the database:

   ```bash
   php artisan migrate
   ```

### Project 2

Repeat the above steps for Project 2, replacing `project1` with `project2`.

## Running the Projects

1. Start the Laravel development server for Project 1:

   ```bash
   php artisan serve
   ```

2. Start the Laravel development server for Project 2:

   ```bash
   php artisan serve --port=8001
   ```

## running up Scheduler

Test the scheduler by running in both directory:

```bash
php artisan schedule:run
```

You should see the scheduled tasks being executed.
