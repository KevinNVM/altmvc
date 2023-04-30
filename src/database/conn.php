<?php

// Require env.php
require_once __DIR__ . '/../core/env.php';

/**
 * Connect to mysql
 * Returns a `mysqli_connect()`
 */



define('host', $_ENV['DB_HOST']);
define('username', $_ENV['DB_USER']);
define('password', $_ENV['DB_PASS']);
define('name', $_ENV['DB_NAME']);

$conn = fn() => mysqli_connect(host, username, password, name) or throw new Exception("Error Connecting To Database", 1);

return $conn;