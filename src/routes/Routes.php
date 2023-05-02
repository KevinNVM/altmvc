<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Instantiate router
$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/api', [HomeController::class, 'api']);

$router->get('/users/{id}', [UserController::class, 'show']);

$router->post('/post-test', [HomeController::class, 'post']);

$router->put('/put-test', [HomeController::class, 'put']);
$router->patch('/patch-test', [HomeController::class, 'patch']);
$router->delete('/delete-test', [HomeController::class, 'delete']);
