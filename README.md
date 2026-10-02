# POS System - TFA3

A Point-of-Sale account management application developed using CodeIgniter 4 and MySQL for IT0049 - Web System Technologies.

## Features

- Customer Accounts listing
- User Accounts listing
- Add new customers
- Add new users
- Form validation
- Unique username validation
- Edit and update customers
- Edit and update users
- User avatar upload
- JPG and PNG image validation
- Maximum avatar size of 2MB
- Prepared 300x300 avatar images
- Placeholder avatar for users without a profile picture
- MySQL database integration
- CodeIgniter MVC architecture

## Database

Database name: `pos_db`

Tables:
- `customers`
- `users`

The database export is included as `pos_db.sql`.

## Main Pages

- `/customers` - Customer Accounts
- `/customers/new` - Add Customer
- `/users` - User Accounts
- `/users/new` - Add User

Edit pages are accessed through the Edit links beside existing records.

## How to Run

1. Install XAMPP and Composer.
2. Place the project inside the XAMPP `htdocs` folder.
3. Start MySQL in XAMPP.
4. Open phpMyAdmin.
5. Create a database named `pos_db`.
6. Import `pos_db.sql`.
7. Configure the database connection in `.env`.
8. Open Command Prompt inside the project folder.
9. Run:

   php spark serve --port 8081

10. Open `http://localhost:8081/customers` in a browser.

## Avatar Upload

User avatars are stored in:

`public/uploads/avatars`

Only JPG and PNG images up to 2MB are accepted. Uploaded images are prepared as 300x300 images, and only the filename is stored in the database.

## Developer

ANGELO BUEN