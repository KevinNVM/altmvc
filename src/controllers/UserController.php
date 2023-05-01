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
        send(200, "Showing user with id: $id");
    }
}
