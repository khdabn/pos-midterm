# Complete Point-of-Sale System

A complete Point-of-Sale management system developed using CodeIgniter 4 and MySQL for the IT0049 Web System Technologies Midterm Project.

## Features

### Product Management
- View products
- Add products
- Edit products
- Delete products
- Product image upload
- JPG/PNG image validation
- Maximum image size of 2MB
- Display-ready product images
- Stock quantity management
- Low-stock indicators

### Customer Management
- View customers
- Add customers
- Edit customers
- Delete customers
- Form validation

### Staff Management
- View staff accounts
- Add staff
- Edit staff
- Delete staff
- Unique usernames
- Hashed passwords
- Avatar upload
- JPG/PNG avatar validation
- Display-ready avatars

### Authentication
- Staff login
- Password verification
- Session-based authentication
- Logout
- Protected management pages

### Sales
- Record a sale
- Select a product
- Optional customer selection
- Walk-in customer support
- Quantity validation
- Automatic total price calculation
- Automatic inventory reduction
- Prevents selling more than available stock
- Sales History
- Records the staff member who completed each sale

## Database

Database name:

`pos_midterm_db`

Tables:

- `products`
- `customers`
- `users`
- `sales`

The database export is included as:

`pos_midterm_db.sql`

## Main Pages

- `/login` - Staff Login
- `/products` - Product Management
- `/products/new` - Add Product
- `/customers` - Customer Management
- `/customers/new` - Add Customer
- `/users` - Staff Management
- `/users/new` - Add Staff
- `/sales/new` - Record Sale
- `/sales` - Sales History

All management pages require authentication.

## Demo Login

Username:

`admin01`

Password:

`password123`

The password is stored as a hash in the database.

## How to Run Locally

1. Install XAMPP and Composer.
2. Place the project inside the XAMPP `htdocs` folder.
3. Start MySQL using XAMPP.
4. Open phpMyAdmin.
5. Create a database named `pos_midterm_db`.
6. Import `pos_midterm_db.sql`.
7. Configure the database connection in `.env`.
8. Open Command Prompt inside the project directory.
9. Run:

   `php spark serve --port 8083`

10. Open:

   `http://localhost:8083`

## Product Images

Product images are stored in:

`public/uploads/products`

Only JPG and PNG files up to 2MB are accepted. Images are prepared as display-ready images, while only the filename is stored in MySQL.

## Staff Avatars

Staff avatars are stored in:

`public/uploads/avatars`

Only JPG and PNG files up to 2MB are accepted. Passwords are stored using secure PHP password hashing.

## Sales Workflow

When a sale is recorded:

1. The selected product is checked for available stock.
2. The requested quantity must be greater than zero.
3. The system rejects quantities greater than the available stock.
4. The total price is calculated using product price × quantity.
5. The sale is stored in the `sales` table.
6. The product stock quantity is reduced.
7. The logged-in staff member is recorded as the seller.

## Developer

GROUP 4