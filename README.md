# About Larashop

Larashop is an online store application (marketplace) that can be used to sell various kinds of goods and users can also buy goods that are integrated with a payment gateway.

# Features

## Admin Cms Larashop ( master account)

| Featured                                       | Create | Read | Update | Delete |
| ---------------------------------------------- | ------ | ---- | ------ | ------ |
| Attribute                                      | ✔      | ✔    | ✔      | ✔      |
| Category                                       | ✔      | ✔    | ✔      | ✔      |
| Slides                                         | ✔      | ✔    | ✔      | ✔      |
| Access Rights                                  | ✔      | ✔    | ✔      | ✔      |
| Orders                                         | ✔      | ✔    | ✔      | ✔      |
| Trashed                                        | ❌     | ✔    | ✔      | ❌     |
| Shipments                                      | ❌     | ✔    | ✔      | ✔      |
| Report Revenue, Product, Inventories, Payments | ❌     | ✔    | ❌     | ❌     |

## Frontend Larashop

| Featured     |
| ------------ |
| Login        |
| Register     |
| Sort Product |
| Checkout     |

## REST API

if you want to test this API you are required to run `php artisan passport:install --uuid` and `php artisan passport:client --client` to get client access

| Action              | Request Url                                                                         |
| ------------------- | ----------------------------------------------------------------------------------- |
| Login               | [POST {BaseUrl}/api/login](#post-{BaseUrl}apilogin)                                 |
| Register            | [POST {BaseUrl}/api/register](#post-{BaseUrl}api/register)                          |
| User                | [GET {BaseUrl}/api/user](#get-{BaseUrl}api/user)                                    |
| Profile             | [GET {BaseUrl}/api/profile](#get-{BaseUrl}api/profile)                              |
| Products            | `GET {BaseUrl}/api/products` or with params `GET {BaseUrl}/api/products?per_page=2` |
| Product Detail      | `GET {BaseUrl}/api/product/{sku}`                                                   |
| Carts Items         | `GET {BaseUrl}/api/carts`                                                           |
| Add Item to Cart    | `POST {BaseUrl}/api/carts`                                                          |
| Update Item in Cart | `PUT {BaseUrl}/api/carts/{cart_id}`                                                 |
| Delete Item in Cart | `DELETE {BaseUrl}/api/carts/{cart_id}`                                              |
| Clear Cart          | `DELETE {BaseUrl}/api/carts`                                                        |
| Shipping Options    | `GET {BaseUrl}/api/carts/shipping-options?city_id=39`                               |
| Set Shipping        | `POST {BaseUrl}/api/carts/set-shipping`                                             |
| Checkout Order      | [POST {BaseUrl}/api/orders/checkout](#post-{BaseUrl}apiorderscheckout)              |

### POST {BaseUrl}/api/login

Example: Create – POST {BaseUrl}/api/login

Request body:

    {
        "email": "example.gmail.com",
        "password": "password",
    }

### POST {BaseUrl}/api/register

Example: Create – POST {BaseUrl}/api/login

Request body:

    {
        "first_name": "John",
        "last_name": "Doe",
        "email": "example.gmail.com",
        "password": "password",
        "password_confirmation": "password"
    }

### GET {BaseUrl}/api/user

Example: Create – GET {BaseUrl}/api/register

Response body:

    {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "example@gmail.com",
        "phone": null,
        "email_verified_at": "2021-02-22T00:22:58.000000Z",
        "company": null,
        "address1": null,
        "address2": null,
        "province_id": null,
        "city_id": null,
        "postcode": null,
        "created_at": "2021-02-22T00:22:58.000000Z",
        "updated_at": "2021-02-22T00:22:58.000000Z"
    }

### GET {BaseUrl}/api/profile

Example: Create – GET {BaseUrl}/api/profile

Response body:

    {
        "code": 200,
        "data": {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "example@gmail.com",
            "phone": null,
            "email_verified_at": "2021-02-22T00:22:58.000000Z",
            "company": null,
            "address1": null,
            "address2": null,
            "province_id": null,
            "city_id": null,
            "postcode": null,
            "created_at": "2021-02-22T00:22:58.000000Z",
            "updated_at": "2021-02-22T00:22:58.000000Z"
        },
        "message": "Success"
    }

### POST {BaseUrl}/api/orders/checkout

Example: Create – POST {BaseUrl}/api/orders/checkout

Request body:

    {
        "shipping_first_name": "John",
        "shipping_last_name": "Doe",
        "shipping_company": "Example PT",
        "shipping_address1": "Jl example 123",
        "shipping_address2": "Apart Example",
        "shipping_province_id": "14",
        "shipping_city_id": "17",
        "shipping_postcode": "12345",
        "shipping_phone": "081234567890",
        "shipping_email": "example.gmail.com",
        "note": "Packing Bubble",
        "shipping_service": "JNE-CTC"
    }

# Build With

-   Laravel 8
-   Bootstrap UI Component
-   Jquery
-   MySql
-   Laravel Auth UI
-   Laravel Cart
-   Laravel Excel
-   Laravel PDF
-   Laravel Spatie Permission
-   Blade Templating
-   Midtrans PHP

# Prerequisite

-   Then Install PHP Version 7
-   Then Install Composer
-   Learn Laravel https://laravel.com/

# Support Me :)

-   Star this repository :star:
-   Hire Me https://www.linkedin.com/in/noorqidam

# Contact

-   WA/TELEGRAM: +62 8577 1603 597
-   email: noorqidam@gmail.com
