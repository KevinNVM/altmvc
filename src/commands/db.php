<?php

function migrate()
{
    // Create a new mysqli connection object with the environment variables
    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the SQL query using the database name from the environment variable
    $query = "CREATE DATABASE IF NOT EXISTS `{$_ENV['DB_NAME']}`;";
    $query .= "USE `{$_ENV['DB_NAME']}`;";
    $query .= "CREATE TABLE IF NOT EXISTS `users` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `fullname` VARCHAR(255) NOT NULL,
                  `username` VARCHAR(50) NOT NULL,
                  `email` VARCHAR(255) NOT NULL,
                  `password` VARCHAR(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    // $query .= "CREATE TABLE IF NOT EXISTS `posts` (
    //                 id INT PRIMARY KEY,
    //                 title VARCHAR(255) NOT NULL,
    //                 slug VARCHAR(255) NOT NULL,
    //                 body TEXT NOT NULL
    //                 );";

    // Execute the query and check for errors
    if ($conn->multi_query($query) === TRUE) {
        echo "Tables created successfully.";
    } else {
        echo "Error creating tables: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

function clear()
{
    // Create a new mysqli connection object with the environment variables
    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the SQL query to drop all tables
    $query = "DROP TABLE IF EXISTS `users`;";
    // $query .= "DROP TABLE IF EXISTS `posts`;";

    // Execute the query and check for errors
    if ($conn->multi_query($query) === TRUE) {
        echo "Tables dropped successfully.";
    } else {
        echo "Error dropping tables: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

function seed()
{
    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USER'];
    $dbPassword = $_ENV['DB_PASS'];
    $dbName = $_ENV['DB_NAME'];

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    // Insert data into users table
    $password = 'password123';
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $queries = [
        "INSERT INTO `users` (`fullname`, `username`, `email`, `password`)
                   VALUES 
                   ('John Doe', 'johndoe', 'johndoe@example.com', '$hashedPassword'),
                   ('Jane Smith', 'janesmith', 'janesmith@example.com', '$hashedPassword')",
        // "INSERT INTO `posts` (id, title, slug, body)
        //             VALUES (1, 'Contoh Judul 1', 'contoh-judul-1', 'Ini adalah contoh isi dari entri pertama.'),
        //                 (2, 'Contoh Judul 2', 'contoh-judul-2', 'Ini adalah contoh isi dari entri kedua.'),
        //                 (3, 'Contoh Judul 3', 'contoh-judul-3', 'Ini adalah contoh isi dari entri ketiga.');"
    ];
    foreach ($queries as $query) {
        mysqli_query($conn, $query);
    }

    mysqli_close($conn);
}