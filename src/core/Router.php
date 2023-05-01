<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $controller)
    {
        $path = trim($path, '/');

        $this->routes[$path] = $controller;
    }

    public function useRouter($path)
    {
        // Get requested route from URL
        $route = preg_replace('/\?.*/', '', $path); // Strip query string from URL
        $route = trim($route, '/'); // Strip trailing slashes from URL

        // Check if route exists in routes array
        foreach ($this->routes as $pattern => $handler) {
            // Replace {parameter} with regular expression for capturing parameter value
            $pattern = str_replace('{id}', '(\d+)', $pattern);

            if (preg_match('#^' . $pattern . '$#', $route, $matches)) {
                // Get controller class and method from routes array
                $controller = $handler[0];
                $method = $handler[1];

                // Remove first element of $matches array, which is the full matched string
                array_shift($matches);

                // Call controller method with wildcard parameter as argument
                $controllerObj = new $controller();
                $controllerObj->$method(...$matches);
                return;
            }
        }

        // handle 404
        abort(404, "Route `$path` Not Found");
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
