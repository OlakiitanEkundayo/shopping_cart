# QuickCart - Laravel Shopping Cart 🛒

QuickCart is a lightweight shopping cart system built with **Laravel 11**, designed as a foundation for modern e-commerce applications.  
It focuses on clean architecture, simplicity, and scalability — making it easy to extend into a full online store.

---

## 🚀 Features

-   Product listing and product detail pages
-   Add/remove items in a session-based cart
-   Checkout flow with order persistence
-   Order management for basic tracking
-   Built with a modular structure for easy future expansion

---

## ⚙️ Installation

Clone the repository and set up your local environment:

```bash
# 1. Clone the repository
git clone https://github.com/OlakiitanEkundayo/shopping_cart.git

# 2. Enter the project folder
cd quickcart

# 3. Install PHP dependencies
composer install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your database in .env

# 7. Run migrations and seed demo data
php artisan migrate --seed

# 8. (Optional) Build frontend assets
npm install && npm run dev

# 9. Start the development server
php artisan serve
```

🛠️ Tech Stack

Laravel 11 – backend framework

MySQL – relational database

Tailwind CSS – styling (switchable with Bootstrap if preferred)

Composer & NPM – dependency management

📌 Project Status

Currently in Phase 1 ✅:

Database schema complete

Product module & cart logic implemented

Checkout basics set up

Next Phase: integrate payment options (Stripe/PayPal) and expand order management features.

🤝 Contributing

This project is still evolving. Contributions, ideas, and suggestions are welcome!
If you’d like to contribute:

Fork the repo

Create a feature branch (git checkout -b feature-name)

Commit your changes

Push and open a Pull Request

📄 License

This project is open-source under the MIT License
