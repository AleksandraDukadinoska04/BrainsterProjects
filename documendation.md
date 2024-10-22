----------VERSIONS----------

Laravel Version: Laravel ^11.9
PHP Version: 8.2.12
Database: MySQL (managed via PHPMyAdmin)
Database Version: 10.4.32-MariaDB
Composer Version : 2.7.7
Node.js Version : v20.9.0
Git Version: 2.42.0.windows.2

---------SET UP THE PROJECT----------

0.Clone the Project:
git clone (link of the cloned gitlab repository) (name of your folder)
cd (your folder)

1.Change the branch:
git checkout Project03

2.Change directory:
cd Project03

3.Install PHP dependencies using Composer:
composer install

4.Copy the .env file:
cp .env.example .env

5.Generate Application Key:
php artisan key:generate

6.Set Database Connection In the .env file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT= your port
DB_DATABASE= your database name
DB_USERNAME= your database user
DB_PASSWORD= your database password

7.Run Migrations:
php artisan migrate

8.Link the storage:
php artisan storage:link

9.Run Seeders:
php artisan db:seed

10.Install Node.js Dependencies:
npm install

11.Build Assets For development:
npm run dev

Or for production:
npm run build

12.Start the Project:
php artisan serve

13.Login as admin:
email: admin@gmail.com
password: admin123
