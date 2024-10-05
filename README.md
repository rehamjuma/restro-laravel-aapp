<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

In a system that has three main models; Product, Ingredient, and Order.
A Burger (Product) may have several ingredients:
- 150g Beef
- 30g Cheese
- 20g Onion
The system keeps the stock of each of these ingredients stored in the database. You
can use the following levels for seeding the database:
- 20kg Beef
- 5kg Cheese
- 1kg Onion
When a customer makes an order that includes a Burger. The system needs to update the
stock of each of the ingredients so it reflects the amounts consumed.
Also when any of the ingredients stock level reaches 50%, the system should send an
email message to alert the merchant they need to buy more of this ingredient.


# Request:
    
The incoming payload may look like this:
{
    "products": 
        [
            {
            "product_id": 1,
            "quantity": 2,
            }
        ]
}


# Installation

<p>
You can start this application by the following steps :</br>
1- cd application directory  && RUN ./vendor/bin/sail build </br>
2- RUN ./vendor/bin/sail up  </br>
2- RUN docker exec -ti restro-app-laravel.test-1 bash </br>
3- php artisan migrate </br>
4- php artisan db:seed </br>
5- Request example :  </br>
curl --location 'http://localhost:8080/api/order' \
--header 'Content-Type: application/json' \
--data '{
    "products": 
        [
            {
            "product_id": 1,
            "quantity": 2
            }
        ]
}'
</p>
