<?php

namespace App\Controllers;

use App\Core\Http\Response;

class HomeController
{
    function index()
    {
        return Response::view('index.php', [
            'frameworkVersion' => $_ENV['VERSION']
        ]);
    }

    public function api()
    {
        return Response::json([
            'status' => 200,
            'message' => 'Welcome to AltMVC Version ' . $_ENV['VERSION']
        ]);
    }

    function post()
    {
        return Response::json('this is post request');
    }
    function put()
    {
        return Response::json('this is put request');
    }
    function patch()
    {
        return Response::json('this is patch request');
    }
    function delete()
    {
        return Response::json('this is delete request');
    }
}