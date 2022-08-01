# Mini-Send API Service

## Project Requirement
- Run Laravel 8, PHP 8.1+
- MySQL or Postgres database

## Installation & Setup
- Clone the repository 
- Create a copy of .env.example as .env in the root directory
- Update the .env with your ``DATABASE DETAILS``
- Run `composer install` to install the dependencies
- Run `php artisan key:generate` to generate the Laravel App Key
- Run `php artisan migreate` to create the database tables
- Run `php artisan test` to test the application, ensure all tests pass successfully.
- Run `php artisan storage:link` to create a symbolik link between storage folders
- Run `php artisan serve` to start the application : `Starting Laravel development server: http://127.0.0.1:8000`
