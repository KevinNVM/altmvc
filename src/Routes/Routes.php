<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Core\Http\Response;

// Instantiate router
$router = new Router();

$router->get('/', [HomeController::class, 'index'])
    ->get('/api', [HomeController::class, 'api'])
    ->get('/users/{id}', function ($id) {
        return Response::view('index.php', [
            'frameworkVersion' => $id
        ])->send();
    });
