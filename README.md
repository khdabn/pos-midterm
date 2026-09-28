# Tasks for Today Management System

A simple task management web application developed using CodeIgniter 4 and MySQL for IT0049 - Web System Technologies.

## Features

- Welcome page showing today's tasks only
- Full Task List showing all tasks ordered by date
- Profile page displaying a demo user
- About page identifying the developer
- MySQL database integration
- MVC architecture using Models, Views, and Controllers

## Database

Database name: `tasks_db`

Tables:
- `tasks`
- `users`

The database export is included in `tasks_db.sql`.

## Pages

- `/` - Tasks for Today
- `/tasks` - Full Task List
- `/profile` - Demo User Profile
- `/about` - About the Developer

## How to Run

1. Install XAMPP and Composer.
2. Place the project inside the XAMPP `htdocs` folder.
3. Start MySQL in XAMPP.
4. Open phpMyAdmin.
5. Create a database named `tasks_db`.
6. Import `tasks_db.sql`.
7. Configure the database connection in `.env`.
8. Open Command Prompt inside the project folder.
9. Run:

   php spark serve

10. Open `http://localhost:8080` in your browser.

## Developer

Angelo Buen