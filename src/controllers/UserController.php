<?php

namespace App\Controllers;

use App\Core\Http\Response;

class UserController
{
    public function index()
    {
    }

    public function show($id)
    {
        return Response::json("Showing user with id : $id");
    }
}
