# Ta'contento

*Ta'contento is a sophisticated system designed for efficient food sales and table reservation management in a restaurant setting. It provides a seamless user experience for both customers and staff, ensuring smooth operations and improved customer satisfaction.*

### Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Technologies Used](#technologies-used)

## Installation
1. Clone the repository: 
```bash
https://github.com/jose-M2020/tacontento
```

2. Import the provided SQL file to set up the necessary database structure. You can use the following command to import the SQL file using the MySQL command-line tool:
```bash
mysql -u [username] -p [database_name] < path/to/sql/file.sql
```
Replace `[username]` with your MySQL username, `[database_name]` with the desired database name, and `path/to/sql/file.sql` with the actual path to the SQL file.

3. Configure the database connection in `database/BD.php` by providing the appropriate credentials.
```php
private static $hostname = 'localhost';
private static $gestor = 'mysql';
private static $database = 'your_database_name';
private static $db_user = 'your_username';
private static $db_password = 'your_password';
```

4. Launch the project using a PHP development server:
- If you have PHP installed globally, navigate to the project's root directory and run the following command:
```bash
php -S localhost:8000
```
- If you are using XAMPP or a similar local development environment, move the project folder to the appropriate web server directory (e.g., htdocs for XAMPP) and access it through the designated URL (e.g., http://localhost/tacontento).

## Usage
Ta'contento offers a user-friendly interface that simplifies the process of ordering food and making table reservations. Customers can easily browse the menu, add items to their cart, and proceed with secure online payments. Restaurant staff can manage orders, track reservations, and ensure smooth operations.

## Features
- User authentication: Secure login and registration functionality
- Order management: Create and manage customer orders
- Reservation management: Create and manage table reservations
- Offer viewing: Browse and view current offers
- Menu browsing: Explore the menu and its various categories
- Menu filtering: Filter menu items based on specific criteria (e.g., dietary restrictions, pricing, etc.)
- Admin functionalities:
  - User management: Create and manage user accounts (e.g., administrators, staff)
  - Offer management: Create and manage promotional offers
  - Order management: Track and manage customer orders
  - Reservation management: Handle table reservations
  - Menu management: Create, update, and organize menu items and categories
  - Sales tracking: Monitor and analyze sales performance

These features provide an overview of the key functionalities available in the Ta'contento system. They aim to enhance user experience, streamline operations, and facilitate efficient management for both customers and restaurant administrators.

## Technologies Used
- PHP
- MySQL
- Bootstrap
- HTML
- JQuery

## Credits
The Ta'contento project was created by the following team members:
- José Manuel Silva Tlaltizapa
- Perla Esmeralda Reyes Pelagio
- José Fernando Galeana Pineda
- Wendy de Jesús Santos
