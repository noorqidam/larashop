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

| Action              | Request Url                                                                                                                                 |
| ------------------- | ------------------------------------------------------------------------------------------------------------------------------------------- |
| Login               | [POST {BaseUrl}/api/login](#post-{BaseUrl}api/login)                                                                                        |
| Register            | [POST {BaseUrl}/api/register](#post-{BaseUrl}api/register)                                                                                  |
| User                | [GET {BaseUrl}/api/user](#get-{BaseUrl}api/user)                                                                                            |
| Profile             | [GET {BaseUrl}/api/profile](#get-{BaseUrl}api/profile)                                                                                      |
| Products            | [GET {BaseUrl}/api/products](#get-{BaseUrl}api/products) or with params [GET {BaseUrl}/api/products?per_page=2](#get-{BaseUrl}api/products) |
| Product Detail      | [GET {BaseUrl}/api/product/{sku}](#get-{BaseUrl}api/products/[sku])                                                                         |
| Carts Items         | [GET {BaseUrl}/api/carts](#get-{BaseUrl}api/carts)                                                                                          |
| Add Item to Cart    | [POST {BaseUrl}/api/carts](#post-{BaseUrl}api/carts)                                                                                        |
| Update Item in Cart | [PUT {BaseUrl}/api/carts/{cart_id}](#put-{BaseUrl}api/carts/[cart_id])                                                                      |
| Delete Item in Cart | [DELETE {BaseUrl}/api/carts/{cart_id}](#delete-{BaseUrl}api/carts/[cart_id])                                                                |
| Clear Cart          | [DELETE {BaseUrl}/api/carts](#delete-{BaseUrl}api/carts)                                                                                    |
| Shipping Options    | [GET {BaseUrl}/api/carts/shipping-options?city_id=39](#get-{BaseUrl}api/carts/shipping-options)                                             |
| Set Shipping        | [POST {BaseUrl}/api/carts/set-shipping](#post-{BaseUrl}api/carts/set-shipping)                                                              |
| Checkout Order      | [POST {BaseUrl}/api/orders/checkout](#post-{BaseUrl}apiorderscheckout)                                                                      |

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

### GET {BaseUrl}/api/products

Example: Create – GET {BaseUrl}/api/products

Response body:

    {
        "code": 200,
        "data": [
            {
                "sku": "AT7946-414",
                "type": "configurable",
                "name": "Sepatu Bola Adidas Copa",
                "slug": "sepatu-bola-adidas-copa",
                "price": "1000000.00",
                "featured_image": "http://127.0.0.1:8000/storage/uploads/images/medium/sepatu-bola-adidas-copa_1613970864.jpg",
                "short_description": "——Spesifikasi——\r\n*Kode Art : G28553\r\n*Warna : White/Core Black/Signal Green\r\n*Harga Retail : Rp 1.000.000 (Abaikan)\r\n*Made In : Indonesia",
                "description": "—— Teknologi——\r\n*Lace closure, Mono-tongue construction→Teknologi ini digunakan pada bagian lidah sepatu, yaitu lidah seaptu menjadi satu dengan bagian upper sepatu. Juga dilengkapi tali pada bagian dalam lidah sepatu yang elastis sehingga akan memudahkan saat pemakaian seaptu.\r\n\r\n*Premium leather upper →material kulit premium asli pada permukaan sepatu selain akan memberikan kesan classic juga akan membuat daya tahan sepatu menjadi lebih bagus lagi.\r\n\r\n*Lightweight TPU outsole → FG outsole memiliki studs rotasi melingkar dan setengah lingkaran untuk digunakan pada permukaan lapangan dengan kontur kering tapi tidak telalu keras.",
                "variants": [
                    {
                        "sku": "AT7946-414-2-4",
                        "type": "simple",
                        "name": "Sepatu Bola Adidas Copa - Putih - 39",
                        "slug": "sepatu-bola-adidas-copa-putih-39",
                        "price": "1000000.00",
                        "featured_image": null,
                        "short_description": null,
                        "description": null
                    },
                    {
                        "sku": "AT7946-414-2-5",
                        "type": "simple",
                        "name": "Sepatu Bola Adidas Copa - Putih - 40",
                        "slug": "sepatu-bola-adidas-copa-putih-40",
                        "price": "1000000.00",
                        "featured_image": null,
                        "short_description": null,
                        "description": null
                    },
                    {
                        sku": "AT7946-414-3-4",
                        "type": "simple",
                        "name": "Sepatu Bola Adidas Copa - Hijau - 39",
                        "slug": "sepatu-bola-adidas-copa-hijau-39",
                        "price": "1000000.00",
                        "featured_image": null,
                        "short_description": null,
                        "description": null
                    },
                    {
                        "sku": "AT7946-414-3-5",
                        "type": "simple",
                        "name": "Sepatu Bola Adidas Copa - Hijau - 40",
                        "slug": "sepatu-bola-adidas-copa-hijau-40",
                        "price": "1000000.00",
                        "featured_image": null,
                        "short_description": null,
                        "description": null
                    }
                ]
            }
        ]
    }

### GET {BaseUrl}/api/products/{sku}

Example: Create – GET {BaseUrl}/api/products/{sku}

Response body:

    {
        "code": 200,
        "data": {
            "sku": "AKS001",
            "type": "simple",
            "name": "Pembersih Sepatu Andrrows Starterkit / Shoe Cleaner Andrrows",
            "slug": "pembersih-sepatu-andrrows-starterkit-shoe-cleaner-andrrows",
            "price": "185000.00",
            "featured_image": "http://127.0.0.1:8000/storage/uploads/images/medium/pembersih-sepatu-andrrows-starterkit-shoe-cleaner-andrrows_1613972346.png",
            "short_description": "ANDRROWS shoe cleaner merupakan produk pembersih sepatu premium pertama dan terbaik di Indonesia yang dibuat dari bahan-bahan natural seperti VCO (virgin coconut oil), jojoba oil, essential oil lemon dan lavender.\r\n\r\nAndrrows Shoe cleaner sama sekali tidak mengandung bahan kimia yang berbahaya jadi sangatlah aman digunakan untuk segala jenis warna dan bahan sepatu, juga aman untuk kulit tangan karena tidak menyebabkan iritasi, aman untuk lingkungan, dan tentunya eco friendly.\r\n\r\nselain aman digunakan, Andrrows Shoe cleaner mudah digunakan karena menggunakan metode dry cleaning “brush it then wipe”, jadi tanpa perlu dibilas dengan air. Mudah kan?",
            "description": "Andrrows Starter Kit:\r\n– 100ml Andrrows Shoe Cleaner (dapat digunakan hingga 50 pasang sepatu)\r\n– Standard Brush (Sikat nylon dengan gagang kayu mahoni yang dapat digunakan di hampir semua bagian sepatu)\r\n– Premium Microfiber Towel (Lap microfiber yang terbuat dari serat fabric berkualitas yang dapat menyerap air 7x lebih banyak dibanding lap konvensional)\r\n\r\nnotes: untuk bahan yang lembut seperti suede, nubuck, genuine leather, cotton mesh, and knit kita sangat merekomendasikan menggunakan Andrrows premium brush"
        },
        "message": "Success"
    }

### GET {BaseUrl}/api/carts

Example: Cart Items – GET {BaseUrl}/api/carts

Response body:

    {
        "code": 200,
        "data": {
            "items": {
                "1679091c5a880faf6fb5e6087eb1b2dc": {
                    "id": "1679091c5a880faf6fb5e6087eb1b2dc",
                    "name": "Pembersih Sepatu Andrrows Starterkit / Shoe Cleaner Andrrows",
                    "price": 185000,
                    "quantity": 5,
                    "attributes": [],
                    "conditions": [],
                    "product": {
                        "sku": "AKS001",
                        "type": "simple",
                        "name": "Pembersih Sepatu Andrrows Starterkit / Shoe Cleaner Andrrows",
                        "slug": "pembersih-sepatu-andrrows-starterkit-shoe-cleaner-andrrows",
                        "price": "185000.00",
                        "featured_image": "http://127.0.0.1:8000/storage/uploads/images/medium/pembersih-sepatu-andrrows-starterkit-shoe-cleaner-andrrows_1613972346.png",
                        "short_description": "ANDRROWS shoe cleaner merupakan produk pembersih sepatu premium pertama dan terbaik di Indonesia yang dibuat dari bahan-bahan natural seperti VCO (virgin coconut oil), jojoba oil, essential oil lemon dan lavender.\r\n\r\nAndrrows Shoe cleaner sama sekali tidak mengandung bahan kimia yang berbahaya jadi sangatlah aman digunakan untuk segala jenis warna dan bahan sepatu, juga aman untuk kulit tangan karena tidak menyebabkan iritasi, aman untuk lingkungan, dan tentunya eco friendly.\r\n\r\nselain aman digunakan, Andrrows Shoe cleaner mudah digunakan karena menggunakan metode dry cleaning “brush it then wipe”, jadi tanpa perlu dibilas dengan air. Mudah kan?",
                        "description": "Andrrows Starter Kit:\r\n– 100ml Andrrows Shoe Cleaner (dapat digunakan hingga 50 pasang sepatu)\r\n– Standard Brush (Sikat nylon dengan gagang kayu mahoni yang dapat digunakan di hampir semua bagian sepatu)\r\n– Premium Microfiber Towel (Lap microfiber yang terbuat dari serat fabric berkualitas yang dapat menyerap air 7x lebih banyak dibanding lap konvensional)\r\n\r\nnotes: untuk bahan yang lembut seperti suede, nubuck, genuine leather, cotton mesh, and knit kita sangat merekomendasikan menggunakan Andrrows premium brush"
                    }
                }
            },
            "shipping_cost": null,
            "tax_amount": null,
            "total": 1017500
        },
        "message": "Success"
    }

### POST {BaseUrl}/api/carts

Example: Create – POST {BaseUrl}/api/carts
for request body size and color it is optional, it can be done when the product has a configurable type

Request body:

    {
        "sku": "AKS001",
        "qty": "5",
        "size": "39",
        "color": "Putih",
    }

### PUT {BaseUrl}/api/carts/{cart_id}

Example: Create – PUT {BaseUrl}/api/carts/{cart_id}

Request body:

    {
        "qty": "3",
    }

### DELETE {BaseUrl}/api/carts/{cart_id}

Example: Delete – DELETE {BaseUrl}/api/carts/{cart_id}

Request body:

    {
        "code": 200,
        "data": true,
        "message": "The item has been deleted"
    }

### DELETE {BaseUrl}/api/carts

Example: Delete – DELETE {BaseUrl}/api/carts

Response body:

    {
        "code": 200,
        "data": true,
        "message": "The item has been deleted"
    }

### GET {BaseUrl}/api/carts/shipping-options

Example: Shipping Options – GET {BaseUrl}/api/carts/shipping-options

Response body:

    {
        "code": 200,
        "data": {
            "origin": "501",
            "destination": 39,
            "weight": 1,
            "results": [
                {
                    "service": "JNE - CTC",
                    "cost": 6000,
                    "etd": "1-2",
                    "courier": "jne"
                },
                {
                    "service": "JNE - CTCYES",
                    "cost": 10000,
                    "etd": "1-1",
                    "courier": "jne"
                },
                {
                    "service": "POS - Paket Kilat Khusus",
                    "cost": 7000,
                    "etd": "2 HARI",
                    "courier": "pos"
                },
                {
                    "service": "POS - Express Next Day Barang",
                    "cost": 10000,
                    "etd": "1 HARI",
                    "courier": "pos"
                },
                {
                    "service": "TIKI - ECO",
                    "cost": 7000,
                    "etd": "4",
                    "courier": "tiki"
                },
                {
                    "service": "TIKI - REG",
                    "cost": 11000,
                    "etd": "2",
                    "courier": "tiki"
                }
            ]
        },
        "message": "success"
    }

### POST {BaseUrl}/api/carts/set-shipping

Example: Create – POST {BaseUrl}/api/carts/set-shipping

Request body:

    {
        "shipping_service": "TIKI-ECO",
        "city_id": 39,
    }

Request body:

    {
        "code": 200,
        "data": {
            "total": "1,007,000"
        },
        "message": "success"
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
