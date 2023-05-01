<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Instantiate router
$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/api', [HomeController::class, 'api']);

$router->get('/users/{id}', [UserController::class, 'show']);

// use router on running app
$router->useRouter($_SERVER['REQUEST_URI']);
