# Molla E-commerce Electronics Webiste

## Description
  Molla is an E-commerce electronics based website that allow users to view, buy products from it. Every user can make an account in the site and place orders, put items in there cart. We build this website with Laravel in the backend and Angular in the front end and used MySQL as the DBMS for this project. This project is submitted as the final graduation project in Sprint's Full-Stack Bootcamp.
 
## Stack

### Server
  Utilizes the [Laravel](https://laravel.com/) PHP framework to handle server functionality providing an out of the box MVC framework API. We used MySQL as RDBMS in this project and used Sanctum library to provide SPA Authenication and to handle the tokens generation and validation.

### Client
 The client side is handled with [Angular](https://github.com/angular) and is completely separated from the server side Laravel application. This means you can work on the front end and back end independently allowing for a true separation of concerns in this fullstack environment.

## Technical Overview
![homepage](/homepage.png)

In This project:
- [x] provide an API for client to register and login using Sanctum.
- [x] provide an API for client to view all products, categories with a pagination and filter.
- [x] provide an API for client to add order with its order items to database.
- [x] provide an API for admin users to view all users, orders.
- [x] provide an API for admin users to add products, categories.
- [x] provide an API for admin users to update certain products or categories.
- [x] provide an API for admin users to delete specific order.
- [x] provide an API for admin users to delete specific user.
- [x] handle the authentication process and token generation.
- [x] user can view the products and their info from the website.
- [x] user can view categories from the website.
- [x] user can put items in his cart and proceed to checkout.
- [x] user can login/register from the site.
- [ ] user can add review to the product.
- [x] user can view products from shop page.

![API](/postman1.png)

![API](/postman2.png)

## Languages and Technologies used
1. HTML5/CSS3
2. Javascript
3. Bootstrap
4. XAMPP
5. PHP
6. MySQL
7. Laravel
8. Laravel/Sanctum
9. JSON
10. Typescript
11. Angular

## Prerequisities
1. Install XAMPP web server
2. Any web browser with latest version.

## Installation
  
  ### Backend
```
cd laravel    
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan serve
```

  ### Frontend
```
cd angular project/molla-ecommerce`
npm install
ng serve
```

## ER Diagram for the project
![Entity Relationship Diagram for the project](/ERD.png)

## Credits

This project is made possible by the sprint Team 2 in the Sprint's Fullstack Bootcamp.

### Contributors
- [Abdelrahman Fayed](https://github.com/AR-Fayed) [ERD-Backend-Frontend]
- [Abdelrahman Gado](https://github.com/abdelrahman-gado) [ERD-Backend-Simple Part in Frontend]
- [AlyaAlnuaimi](https://github.com/AlyaAlnuaimi) (Frontend)
- [Mohammed Tarek](https://github.com/MohamedTarekSkr) (ERD -Authenication part in frontend only)
