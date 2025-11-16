📌 TaskAssigner – Laravel Application

A powerful and flexible Laravel-based system for managing tasks, teams, projects, subscriptions, and more.
This application is designed with clean routes, organized controllers, and a straightforward user flow.

🚀 Installation & Setup

Follow these steps to run the project on your machine:

1️⃣ Install Composer Dependencies
composer install

2️⃣ Run Database Migrations
php artisan migrate

3️⃣ Seed the Database
php artisan db:seed --class=AllSeeders

4️⃣ Clear Cached Files (Highly Recommended After Cloning)

Run these to avoid "view not found", "config not found", or caching issues:

php artisan optimize:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear

▶️ Start the Application

Run the development server:

php artisan serve


Then open the home page:

🔗 http://localhost:8000/home

👨‍💻 Developer

Built with ❤️ by Ahmed Emad
Good luck! :)
