<?php

namespace App\Controllers;

use App\Core\Http\Response;
use App\Core\Response\View;

class HomeController
{
    function index(): View
    {
        # Rendering view using `App\Core\Http\Response::class`
        return
            Response::view(
                view: 'index',
                withLayout: 'main/app'
            );

        # Rendering view using `App\Core\Response\View::class`
        return
            View::make('index')->withLayout('main/app');
    }
}
