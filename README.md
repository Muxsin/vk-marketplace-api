# VK Marketplace 2024

## Requirement

- Docker
- Docker Compose
- Composer

## Installation

1. Copy the `.env.example` file and rename it to `.env`. Set up database configuration in the `.env` file.
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```
2. Run `composer install` to install dependencies

## Running

1. Run `./vendor/bin/sail up -d` to start the project
1. Run `./vendor/bin/sail php artisan key:generate` to generate app key
1. Run `./vendor/bin/sail php artisan migrate --seed` to initialize database
1. Visit http://localhost:8080
1. Enjoy!

## Authorization

For authorization provide the token in `Authorization` header. Format: `Bearer <token>`

## Endpoints

### User

- `POST /api/login`
    - **Access:** guest
    - **Body:** 
      - `login`: string
      - `password`: string
    - **Description:** Login method. If the received data is correct, then returns the authorization token if successful.
- `POST /api/register`
    - **Access:** guest
    - **Body:**
      - `login`: string
      - `password`: string
    - **Description:** User creation method. If the response is successful, returns the added user's data.

### Product

- `GET /api/product`
    - **Access:** guest, authorized
    - **Parameters:** 
      - `page`: number
      - `sort_by`: created_at, price
      - `sort_type`: asc, desc
      - `filter_by`: price
      - `filter_min`: float
      - `filter_max`: float
      - `filter_exact`: float
    - **Description:** Product creation method. If the response is successful, returns the data of the added product.
    - **Examples:**
      - Pagination: `/api/product?page=2`
      - Sorting: `/api/product?sort_by=price&sort_type=desc`
      - Filtering: 
        - `/api/product?filter_by=price&filter_min=1001&filter_max=3002`
        - `/api/product?filter_by=price&filter_exact=599.52`
- `POST /api/product`
    - **Access:** authorized
    - **Body:** 
      - `title`: string
      - `description`: string
      - `image`: string
      - `price`: float
    - **Description:** Product creation method. If the response is successful, returns the data of the added product.
