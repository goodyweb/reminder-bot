![landingpage](https://user-images.githubusercontent.com/125423452/229718350-ff299536-31bf-494b-b63d-1a4b968c4499.png)

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
![register](https://user-images.githubusercontent.com/125423452/229719673-3c21b712-b300-4854-ad19-d000c826c6fe.png)

2. Login
![login](https://user-images.githubusercontent.com/125423452/229720818-8458ec66-f94c-4fc9-8ebc-1b404a581ea1.png)

3. Forgot your password
![forgot](https://user-images.githubusercontent.com/125423452/229721182-1ede2aae-1962-416e-9ffc-3451c15ec6df.png)

4. Dashboard <br>
After logging in for the first time, you can see on the dashboard the number of users, fixed date upcoming events, and unfixed date upcoming events.
![dashboard](https://user-images.githubusercontent.com/125423452/229721723-0716ded5-ba0b-4e09-8b7e-52b56b286d4e.png)

5. Fixed Date <br>
    - Card View
    ![cardviewfixed](https://user-images.githubusercontent.com/125423452/229721977-3c3e121d-4369-470c-8c62-007b24d5e4ac.png) 
    - Table View
    ![tableviewfixed](https://user-images.githubusercontent.com/125423452/229722168-8c621f0e-cd21-41d2-a3db-893e65ff88ef.png)
6.  Unfixed Date <br>
    - Card View
    ![cardviewunfixed](https://user-images.githubusercontent.com/125423452/229722317-bd31b03a-0ee6-4f89-ae01-3f6c548d66a8.png)
    - Table View
    ![tableviewunfixed](https://user-images.githubusercontent.com/125423452/229722774-5b63a1e9-4c60-4c9d-a894-64f21b9f2a48.png)
7. View, Edit, and Delete Reminder <br>
If you go to Fixed Date and Unfixed Date Reminders. Here you can view all the reminders. Reminders can be viewed, edited, deleted from there. <br>
8. Add New Reminders
    - Fixed Date Reminder
    ![addfixed](https://user-images.githubusercontent.com/125423452/229723544-b41d912d-701f-4af1-aa3c-e7f29913157d.png)
    - Unfixed Date Reminder
    ![addunfixed](https://user-images.githubusercontent.com/125423452/229723699-924c0b15-a0e7-4db8-b730-099f83c0ec20.png)
9. php artisan schedule:work <br>
Run <code>php artisan schedule:work</code>after adding a reminder to allow it to execute and sends data to the specified webhook.
<br>

