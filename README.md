# Bazaar

Bazaar is an online marketplace for handmade goods, gifts and party supplies. It is a web store written in plain PHP, using an MVC folder structure and MySQL. Customers browse products by category, keep a wishlist and cart, and place orders. Admins manage products, users, orders and customer feedback from a dashboard.

The project started as a university software-engineering course project (the UML diagrams are in [`docs/`](docs/)). I'm now developing it further into a complete marketplace. The plan is in the [roadmap](#roadmap).

## Tech stack

- **Backend:** PHP 8 (no framework), PDO for database access
- **Database:** MySQL 8 / MariaDB
- **Frontend:** HTML, CSS, vanilla JavaScript
- **Architecture:** Model / View / Controller folders

## Features

### Customers
- Register, log in, log out and change password (passwords hashed with `password_hash`)
- Browse products by category: fashion, jewelry & watches, home & living, gifts & occasions, party supplies, gift cards, statues
- Wishlist: add, remove, move to cart
- Shopping cart: add, update quantity, remove
- Checkout and order confirmation
- "My orders" page with order details
- Profile page
- Contact / feedback form

### Admins
- Dashboard (`view/admins.php`)
- Product management: add, edit, delete, with image upload
- User management: add, edit, delete, set roles (`customer` / `admin`)
- Order management
- Reports
- Read customer feedback
- Notifications for new activity

## Project structure

```
config/        Database settings (config.php is local; see config.example.php)
controller/    Request handlers (cart, wishlist, checkout, auth, admin actions)
database/      schema.sql - table structure only
docs/          UML: use-case, sequence and class diagrams
includes/      Database connection, session and helper functions
model/         User, Product, Cart, CartItem, Order, OrderItem, Wishlist, Feedback, Notification, Admin
view/          Pages, CSS, JavaScript and uploaded images
```

## Getting started

1. Install PHP 8+ and MySQL. XAMPP, WAMP or Laragon all work.
2. Clone the repository into your web server's root (for example `htdocs/`):
   ```bash
   git clone https://github.com/kareemmsms/bazzar.git
   ```
3. Create a database named `bazaar` and import the schema:
   ```bash
   mysql -u root -p bazaar < database/schema.sql
   ```
4. Put your database credentials in `config/config.php` (`config/config.example.php` is a clean template).
5. Open `http://localhost/bazzar/view/index.php`.
6. Register an account. To make it an admin, set `user_type = 'admin'` for that user in the `users` table.

## Roadmap

- [ ] Load database credentials from environment variables instead of a PHP file
- [ ] Add CSRF tokens to all forms and review every query for prepared statements
- [ ] Fix the `redirect()` helper (it currently ignores its URL argument)
- [ ] Use consistent file naming for controllers and views
- [ ] Product reviews and ratings
- [ ] Discount coupons
- [ ] Product search and filters
- [ ] Online payment integration
- [ ] Order status emails
- [ ] PHPUnit tests and a GitHub Actions workflow

## License

All rights reserved © Kareem.
