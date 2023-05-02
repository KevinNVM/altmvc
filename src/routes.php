<?php

// make a simple controller logic
// example: 
// if the url is '/' check for a function with the value home() if found then run it, it will act as a default views/controller
// if the url is '/about' check for a function with the value about() if found then run it. if not then render a string that says '404'

require __DIR__ . '/database/db.php';
require __DIR__ . '/controllers/controller.php';

/**
 * Routes Section
 * Define routes by simply making a function an adding the array list
 * '<string url>' => '<string function_name>'
 * or
 * '<string url>' => 'callback()'
 * or
 * 'strign url>' => 'send(callback())'
 * 
 * Use `view(path, data)` global function for rendering views file. 
 * `path` is relative to the `src/views` folder.
 */
$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/posts' => 'posts_index',
    '/posts/{slug}' => 'posts_show'
];

/**
 * Parsing URL Section. Make changes as you need.
 */

// Parse URL
$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if (empty($path)) {
    $path = '/';
}

foreach ($routes as $route => $function_name) {
    // Handle placeholder
    if (strpos($route, '{') !== false) {
        $route_regex = preg_replace('/\{(.+?)\}/', '(?P<$1>[^/]+)', $route);
        if (preg_match("#^$route_regex$#", $path, $matches)) {
            if (is_string($function_name) && function_exists($function_name)) {
                try {
                    call_user_func($function_name, $matches[1] ?? null);
                } catch (Exception $e) {
                    $errorMessage = $e->getMessage();
                    $statusCode = 500;
                }
            } elseif (is_callable($function_name)) {
                call_user_func($function_name, $matches);
            } else {
                $errorMessage = "Controller does not exist.";
                $statusCode = 500;
            }

            if (isset($errorMessage)) {
                abort($statusCode, $errorMessage);
            }

            exit();
        }
    } elseif ($route === $path) {
        if (is_string($function_name) && function_exists($function_name)) {
            try {
                call_user_func($function_name);
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                $statusCode = 500;
            }
        } elseif (is_callable($function_name)) {
            call_user_func($function_name);
        } else {
            $errorMessage = "Controller does not exist.";
            $statusCode = 500;
        }

        if (isset($errorMessage)) {
            abort($statusCode, $errorMessage);
        }

        exit();
    }
}

abort(404, "Route `$path` is not found");