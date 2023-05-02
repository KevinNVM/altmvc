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
