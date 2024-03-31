# Wallet Management System

This is a wallet management system built with Laravel. It allows users to manage customers and their associated wallets, including CRUD operations for customers, adding/deducting balance from wallets, and soft deletes.

## Requirements

- PHP >= 7.4
- Composer
- MySQL or any other supported database management system

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/nmohamedjassim/wallet_mgmt.git

2. Navigate into the project directory:

   ```
   cd wallet_mgmt
   ```

3. Install PHP dependencies using Composer:

   ```
   composer install
   ```

4. Copy the .env.example file to .env and configure your environment variables:

   ```
   cp .env.example .env
   ```
   - Set up your database connection details in the .env file.
   - Generate a new application key:
     
   ```
   php artisan key:generate
   ```

5. Run the database migrations to create the necessary tables:

   ```
   php artisan migrate
   ```
      
6. Seed the database with sample data:

   ```
   php artisan db:seed
   ```

7. Start the development server:

   ```
   php artisan serve
   ```
