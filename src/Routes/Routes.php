<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Core\Http\Response;

// Instantiate router
$router = new Router();

$router->get('/', function () {
    $dsn = "mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_NAME"]};charset=utf8mb4";
    $db = new PDO(
        dsn: $dsn,
        username: $_ENV["DB_USER"],
        password: $_ENV["DB_PASS"]
    );
    return Response::json(
        [
            'data' => $db->query("SELECT * FROM users")->fetch(
                mode: PDO::FETCH_OBJ
            )
        ]
    );
});

$router->get('/about', function () {
    return Response::view('hello world', [
        'frameworkVersion' => $_ENV["VERSION"]
    ], forceRender: true);
});
