<?php

use App\Controllers\HomeController;
use App\Core\Router;
use App\Core\Http\Response;

// Instantiate router
$router = new Router();

$router->get('/', [HomeController::class, 'index']);
