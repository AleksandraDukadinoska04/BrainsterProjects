----------VERSIONS----------

Laravel Version: Laravel ^11.9
PHP Version: 8.2.12
Database: MySQL (managed via PHPMyAdmin)
Databas Version: 10.4.32-MariaDB
Composer Version : 2.7.7
Node.js Version : v20.9.0
Git Version: 2.42.0.windows.2

---------SET UP THE PROJECT----------

1.Clone the Project:
git clone (link of the cloned gitlab repository)
cd (your folder)

2.Install PHP dependencies using Composer:
composer install

3.Copy the .env file:
cp .env.example .env

4.Generate Application Key:
php artisan key:generate

5.Set Database Connection In the .env file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT= your port
DB_DATABASE= your database name
DB_USERNAME= your database user
DB_PASSWORD= your database password

6.Run Migrations:
php artisan migrate

7.Link the storage:
php artisan storage:link

8.Run Seeders:
php artisan db:seed

9.Install Node.js Dependencies:
npm install

10.Build Assets For development:
npm run dev

Or for production:
npm run build

11.Start the Project:
php artisan serve

12.Login as admin:
email: admin@gmail.com
password: admin123
