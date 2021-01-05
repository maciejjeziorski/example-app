# Example App

## About

- Simple application with client- and admin- panels.
- CRUD for projects and tasks.
- API in Laravel, frontend in React.
- PHPUnit tests 70%.

## Requirements

- [PHP requirements for Laravel 8](https://laravel.com/docs/8.x/deployment#server-requirements)
- MySQL/MariaDB database (preferred)
- Node.js 12.9.1 or higher
- NPM 6.10.2 or higher

## Installation

1. Clone this repository
2. Run `cp .env.example .env`
3. Configure the `.env` file
4. Run `composer install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate --seed`
7. Open the application in a browser (`http://localhost`)

## Author
Maciej Jeziorski, 01/2021.
