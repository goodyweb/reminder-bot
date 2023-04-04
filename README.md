<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Documentation

# Table of Contents
1. [GOODYMinder](#GOODYMinder)
2. [Pre-requisite](#pre-requisite)
3. [Installation](#Installation)
    1. [Clone the repository](#clone)
    2. [Database Configuration](#database-configuration)
4. [Steps to follow](#steps-to-follow)

## GOODYMinder<a name="GOODYMinder"></a>

GOODYMinder is a reminder bot system, designed by Goody Web Solutions Inc. first student interns from Central Mindanao University, was built using Laravel 9 and bootstrap.

## Pre-requisite<a name="pre-requisite"></a>
- XAMPP
- NPM
- Git/Git Bash
- Composer

## Installation<a name="Installation"></a>
- Download this project or clone this repo and save to your local.

1. Clone the Repository<a name="clone"></a>
- Go to <code>C:/xampp/htdocs</code>
    - <code>cd 'C:/xampp/htdocs'</code>
- Clone the repository
    - Run <code>git clone https://github.com/hectordolo/laravel-sbadmin.git</code>
- Go to the 'Project_Directory'
    - <code>cd 'PROJECT_DIRECTORY'</code>
- Install all Dependencies needed
    - Run <code>composer install</code> 
<br><br>
2. Database Configuration<a name="database-configuration"></a>
- Run both <code>Apache</code> and <code>MySQL</code> in the XAMPP Control Panel
- Go to <code>localhost/phpmyadmin</code> in your browser or Navicat. Create new database on your database.
- copy <code>.env.example</code> to <code>.env</code>
- edit <code>.env</code>
    - set <code>DB_DATABASE = "Your_Database_name"</code>
    - set <code>DB_USERNAME = "Your_username"</code>
    - set <code>DB_Password = "Your_password"</code>
- Generate application key
    - <code>php artisan key:generate</code>
- Run command <code>php artisan migrate</code> to generate all table migrations which is exist in this project.
- Run command <code>php artisan optimize</code> to creates a compiled file of commonly used classes in other to reduce the amount of files that must be included on each request.
- Run <code>php artisan serve</code> to start your laravel server.
- You can now register a new user to use the system.

## Steps to follow<a name="steps-to-follow"></a>
1. Register

3. Login
4. Forgot your password
5. Dashboard <br>
After logging in for the first time, you can see on the dashboard the number of users, all reminders, and the upcoming events.
5. View, Edit, and Delete Reminder <br>
If you go to Reminders. Here you can view all reminders. Reminders can be viewed, edited, deleted from here.
6. Reminders <br>
    - Card View

    - Table View

7. Add New Reminder
    - Multiple Reminder

    - Countdown Reminder


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
