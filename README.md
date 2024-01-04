# Mini Internet Bank

Mini Internet Bank is a web application developed using PHP with the Laravel framework, backed by MySql. The front-end is powered by jQuery, providing a user-friendly interface for banking operations. This project includes features for account management, cryptocurrency activities, fund transactions, and a dashboard for monitoring financial activities.

## Features 

### Login Page
![Login Feature](images/login_page.png)

### Register Page
![Register Feature](images/register_page.png)

### User Dashboard
![User Dashboard Feature](images/user_dashboard.png)

### Transactions
![Transactions Feature](images/transactions.png)

### Crypto Dashboard
![Crypto Dashboard Feature](images/crypto_dashboard.png)

### Investment Dashboard
![Investment Dashboard Feature](images/investment_dashboard.png)

## Requirements
* Git
* Code Editor (e.g., PHPStorm or any other)
* MySql (or any compatible database for data storage)
* PHP
* PHP Extensions for Laravel

## Installation Guide
### Setting up

1. **Git:**
   - Install Git on your machine.
   - Initialize a new Git repository for your Mini Internet Bank project.

2. **Code Editor:**
   - Choose and install a code editor (e.g., PHPStorm, Visual Studio Code, Sublime Text).

3. **MySQL or Compatible Database:**
   - Install MySQL or any compatible database system.
   - Set up a new database for your Mini Internet Bank project.

4. **PHP:**
   - Install PHP on your machine.
   - Ensure that PHP is added to your system's PATH.

5. **PHP Extensions for Laravel:**
   - Install required PHP extensions for Laravel.

6. **Laravel Setup:**
   - Clone your Mini Internet Bank Git repository.
   - Run `composer install` to install Laravel dependencies.
   - Create a copy of the `.env.example` file and name it `.env`.
   - Configure your `.env` file with database details and other necessary settings.
   - Generate an application key using `php artisan key:generate`.

7. **Database Migrations:**
   - Run database migrations using `php artisan migrate` to set up the required database tables.

8. **Serve the Application:**
   - Run the development server using `php artisan serve` to start your Mini Internet Bank locally.

9. **Testing:**
   - Test your application to ensure all features work as expected.

 ## Commands

Initiate instant updates with the following commands:

- `php artisan update-cryptocurrencies`: Updates all available cryptocurrencies in the system and their rates.
- `php artisan exchange-rates:update-specific`: Updates exchange rates, allowing seamless currency transfers between accounts.
- `php artisan update-investments`: Keeps the investment page up-to-date with the latest data.
- `php artisan update-balances`: Updates cryptocurrency balances, ensuring accuracy after modifying the cryptocurrencies table.

 ## Usage

Explore the comprehensive features of the Mini Internet Bank App:

- **Account Management:**
  - Create and manage accounts effortlessly.

- **Fund Transactions:**
  - Send and receive money seamlessly.
  - Utilize the updated exchange rates for currency conversions when sending money.

- **Cryptocurrency Activities:**
  - Buy and sell cryptocurrencies based on the latest market data.

- **Investment Management:**
  - Stay informed about investment opportunities and portfolio performance.

- **Command Integration:**
  - Run commands to keep cryptocurrency data, exchange rates, investments, and balances up-to-date.

Enjoy a seamless and feature-rich banking experience with the Mini Internet Bank App!

  
