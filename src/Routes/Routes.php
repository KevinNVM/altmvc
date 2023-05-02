<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Instantiate router
$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/api', [HomeController::class, 'api']);

$router->get('/users/{id}', function ($id) {
    dd($id);
});

$router->get('/users/{name}/{id}', function ($name, $id) {
    dd($name, $id);
});

$router->get('/users/{name}/{id}/{email}', function ($name, $id, $email) {
    dd($name, $id, $email);
});

$router->get('/users/{name}/{id}/{email}/{asdasd}', function (...$param) {
    dd(...$param);
});
