<?php

namespace App\Controllers;

use App\Core\Http\Response;

class HomeController
{
    function index()
    {
        return Response::view('index.php', [
            'frameworkVersion' => $_ENV['VERSION']
        ])->send();
    }

    public function api()
    {
        return Response::json([
            'status' => 200,
            'message' => 'Welcome to AltMVC Version ' . $_ENV['VERSION']
        ]);
    }
}
