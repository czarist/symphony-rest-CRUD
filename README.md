# Symfony Product API

This is a RESTful API built with Symfony for managing products and categories, using MySQL as the database. The project is containerized with Docker.

## Installation and Setup

### 1. Start the Containers
Run the following command to build and start all required services:
```sh
docker-compose up -d --build
```

### 2. Access the PHP Container
To execute commands inside the Symfony environment, enter the PHP container:
```sh
docker exec -it symfony-php bash
```

### 3. Install Dependencies
Once inside the container, install the necessary dependencies:
```sh
composer install
```

### 4. Run Database Migrations
Run the following commands to set up the database:
```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Running the Application
The application should now be running at:
```
http://localhost:8080
```

## API Documentation

### 1. Create a Product
**Endpoint:**
```
POST /products
```
**Request Body:**
```json
{
    "name": "Notebook Dell",
    "price": 3500.50,
    "status": "available",
    "category_id": 1
}
```
**Response:**
```json
{
    "id": 1,
    "name": "Notebook Dell",
    "price": "3.500,50",
    "status": "available",
    "category": {
        "id": 1,
        "name": "Electronics"
    }
}
```

### 2. Get All Products
**Endpoint:**
```
GET /products
```
**Response:**
```json
[
    {
        "id": 1,
        "name": "Notebook Dell",
        "price": "3.500,50",
        "status": "available",
        "category": {
            "id": 1,
            "name": "Electronics"
        }
    },
    {
        "id": 2,
        "name": "Mechanical Keyboard",
        "price": "499,90",
        "status": "out_of_stock",
        "category": {
            "id": 1,
            "name": "Electronics"
        }
    }
]
```

### 3. Get a Single Product
**Endpoint:**
```
GET /products/{id}
```
**Response:**
```json
{
    "id": 1,
    "name": "Notebook Dell",
    "price": "3.500,50",
    "status": "available",
    "category": {
        "id": 1,
        "name": "Electronics"
    }
}
```
If the product does not exist:
```json
{
    "error": "Product not found"
}
```

### 4. Update a Product
**Endpoint:**
```
PUT /products/{id}
```
**Request Body:**
```json
{
    "name": "Notebook Dell XPS",
    "price": 4000.99,
    "status": "available"
}
```
**Response:**
```json
{
    "id": 1,
    "name": "Notebook Dell XPS",
    "price": "4.000,99",
    "status": "available",
    "category": {
        "id": 1,
        "name": "Electronics"
    }
}
```

### 5. Delete a Product
**Endpoint:**
```
DELETE /products/{id}
```
**Response:**
```json
{
    "message": "Product deleted"
}
```
If the product does not exist:
```json
{
    "error": "Product not found"
}
```

### 6. Create a Category
**Endpoint:**
```
POST /categories
```
**Request Body:**
```json
{
    "name": "Electronics"
}
```
**Response:**
```json
{
    "id": 1,
    "name": "Electronics"
}
```

### 7. Get All Categories
**Endpoint:**
```
GET /categories
```
**Response:**
```json
[
    {
        "id": 1,
        "name": "Electronics"
    },
    {
        "id": 2,
        "name": "Books"
    }
]
```

### 8. Get a Single Category
**Endpoint:**
```
GET /categories/{id}
```
**Response:**
```json
{
    "id": 1,
    "name": "Electronics"
}
```
If the category does not exist:
```json
{
    "error": "Category not found"
}
```

### 9. Update a Category
**Endpoint:**
```
PUT /categories/{id}
```
**Request Body:**
```json
{
    "name": "Computers and Accessories"
}
```
**Response:**
```json
{
    "id": 1,
    "name": "Computers and Accessories"
}
```

### 10. Delete a Category
**Endpoint:**
```
DELETE /categories/{id}
```
**Response:**
```json
{
    "message": "Category deleted"
}
```
If the category does not exist:
```json
{
    "error": "Category not found"
}
```

## Environment Variables
The application uses the following environment variables, which can be configured in the `.env` file:
```
DATABASE_URL="mysql://user:password@mysql:3306/database_name"
```
Ensure that these values match your database settings inside `docker-compose.yml`.

## Running Tests
To run tests inside the container, use:
```sh
php bin/phpunit
```

## License
This project is open-source and available under the MIT license.

