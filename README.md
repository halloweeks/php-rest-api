# PHP REST API with MySQL Database Connectivity

This repository contains a basic implementation of a RESTful API in PHP with MySQL database connectivity. The API provides endpoints for performing CRUD (Create, Read, Update, Delete) operations on user data. It utilizes PHP's built-in `mysqli` extension for interacting with the MySQL database.

## Features

- Enables cross-origin requests using CORS headers

- Supports CRUD operations on user data

- Handles JSON data for request and response payloads

- Provides error handling and appropriate HTTP response codes

- Includes a database dump file (`test.sql`) with sample data

## Requirements

- PHP 7 or later

- MySQL database

## Getting Started

1. Clone the repository:

   ```bash

   git clone https://github.com/halloweeks/php-rest-api.git

   ```

2. Import the `test.sql` file into your MySQL database.

3. Configure the database connection settings:

   - Open `database.php`.

   - Modify the following lines with your MySQL database credentials:

     ```php

     $mysqli = new mysqli('127.0.0.1', 'root', '1234');

     ```

4. Upload the code to your PHP server.

5. Test the API endpoints using your preferred HTTP client (e.g., cURL, Postman).

## API Endpoints

The following endpoints are available:

- `POST /api/v1/account/info`: Retrieve user information by user ID.

  Example request body:

  ```json

  {

    "user_id": 1

  }

  ```

  Example response:

  ```json

  {

    "user_id": 1,

    "username": "user 1",

    "email": "user1@gmail.com"

  }

  ```

## Contributing

Contributions are welcome! If you find any issues or want to enhance the functionality, feel free to open a pull request.

## License

This project is licensed under the [MIT License](LICENSE).


