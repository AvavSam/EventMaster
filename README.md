# EventMaster

A comprehensive Laravel-based event management system for organizing, promoting, and managing events.

![Build Status](https://img.shields.io/badge/build-passing-brightgreen)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Laravel Version](https://img.shields.io/badge/Laravel-v12.10-red)

## Table of Contents

- [EventMaster](#eventmaster)
  - [Table of Contents](#table-of-contents)
  - [About The Project](#about-the-project)
    - [Why This Project?](#why-this-project)
  - [Features](#features)
  - [Technology Stack](#technology-stack)
  - [Project Structure](#project-structure)
  - [Installation](#installation)
    - [Prerequisites](#prerequisites)
    - [Setup Instructions](#setup-instructions)
  - [Usage](#usage)
    - [User Authentication](#user-authentication)
    - [Event Management](#event-management)
    - [Event Discovery \& Registration](#event-discovery--registration)
  - [Deployment](#deployment)

## About The Project

EventMaster is a powerful event management platform developed using the Laravel framework. This project serves as the final assignment (tugas besar/tubes) for the Web Programming 2 practical course. The application provides comprehensive tools for event creators, attendees, and administrators to create, manage, discover, and participate in various types of events.

The platform allows users to create events, sell tickets, manage registrations, and analyze attendance metrics. With an intuitive user interface and robust backend functionality, EventMaster streamlines the entire event management process from conception to completion.

### Why This Project?

* Solves real-world event management challenges
* Demonstrates practical application of web development skills
* Provides a scalable solution for event organizers of all sizes
* Incorporates modern user experience design with powerful backend features

## Features

* **Event Creation and Management**
  * Create and publish events with detailed information
  * Set custom ticket types and pricing
  * Manage event capacity and registration limits
  * Schedule recurring events

* **User Registration and Profiles**
  * Secure user authentication system
  * Personalized dashboards for organizers and attendees
  * Event history and saved preferences
  * Social sharing capabilities

* **Ticketing System**
  * Multiple ticket tiers and pricing options
  * QR code generation for easy check-in
  * Automated email confirmations
  * Refund and transfer capabilities

* **Search and Discovery**
  * Advanced filtering and categorization
  * Location-based event search
  * Personalized event recommendations
  * Featured and trending events sections

* **Analytics and Reporting**
  * Attendance tracking and statistics
  * Revenue reporting
  * Marketing performance metrics
  * Export capabilities for data analysis

## Technology Stack

* **Backend**
  * [PHP 8.2+](https://www.php.net/) - Primary programming language
  * [Laravel 12](https://laravel.com/) - PHP web framework
  * [MySQL](https://www.mysql.com/) - Database for event and user data

* **Frontend**
  * [Blade](https://laravel.com/docs/blade) - Laravel's templating engine
  * [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript) - Interactive UI elements
  * [CSS3](https://developer.mozilla.org/en-US/docs/Web/CSS) - Responsive styling
  * [Bootstrap](https://getbootstrap.com/) - UI framework for responsive design

* **Tools & Libraries**
  * [Composer](https://getcomposer.org/) - PHP dependency manager
  * [FakerPHP](https://github.com/fakerphp/faker) - Test data generation
  * [Guzzle](https://github.com/guzzle/guzzle) - Location API integration
  * [Laravel Cashier](https://laravel.com/docs/billing) - Payment processing

* **Testing**
  * [PHPUnit](https://phpunit.de/) - Testing framework

## Project Structure

The application follows Laravel's standard directory structure with some custom organization:

```
eventmaster/
├── app/                    # Application core code
│   ├── Console/            # Custom Artisan commands
│   ├── Http/               # Controllers, Middleware, Requests
│   │   ├── Controllers/    # Application controllers
│   │   ├── Middleware/     # HTTP middleware
│   │   └── Requests/       # Form requests & validation
│   ├── Models/             # Eloquent models
│   ├── Providers/          # Service providers
│   └── Services/           # Business logic services
├── bootstrap/              # Framework bootstrap files
├── config/                 # Configuration files
├── database/               # Database migrations & seeds
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── public/                 # Publicly accessible files
│   ├── css/                # Compiled CSS
│   ├── js/                 # Compiled JavaScript
│   └── storage/            # Public storage symlink
├── resources/              # Frontend resources
│   ├── css/                # CSS source files
│   ├── js/                 # JavaScript source files
│   └── views/              # Blade templates
├── routes/                 # Application routes
│   ├── api.php            # API routes
│   └── web.php            # Web routes
├── storage/                # Application storage
├── tests/                  # Automated tests
└── vendor/                 # Composer dependencies
```

## Installation

### Prerequisites

* PHP >= 8.2
* Composer
* MySQL or PostgreSQL
* Node.js & npm (for frontend assets)

### Setup Instructions

1. Clone the repository
   ```sh
   git clone https://github.com/AvavSam/EventMaster.git
   cd EventMaster
   ```

2. Install PHP dependencies
   ```sh
   composer install
   ```

3. Install JavaScript dependencies
   ```sh
   npm install
   ```

4. Create environment file
   ```sh
   cp .env.example .env
   ```

5. Generate application key
   ```sh
   php artisan key:generate
   ```

6. Configure your database in the .env file
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eventmaster
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Run database migrations and seeders
   ```sh
   php artisan migrate --seed
   ```

8. Compile assets
   ```sh
   npm run dev
   ```

9. Create storage symlink
   ```sh
   php artisan storage:link
   ```

10. Start the development server
    ```sh
    php artisan serve
    ```

11. Visit http://localhost:8000 in your browser

## Usage

### User Authentication

1. Register a new account at `/register`
2. Login with your credentials at `/login`
3. Access your personalized dashboard at `/dashboard`

### Event Management

1. Create a new event at `/events/create`
2. Manage your events at `/organizer/events`
3. View analytics and attendance at `/organizer/analytics`
4. Export attendee data in various formats (CSV, PDF)

### Event Discovery & Registration

1. Browse events at `/events`
2. Search for events by category, date, or location
3. Register for events and purchase tickets
4. Access your tickets at `/my-tickets`


## Deployment

1. Configure your production environment
2. Set appropriate environment variables in production
3. Optimize the application:
   ```sh
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Configure your web server (Apache/Nginx)
