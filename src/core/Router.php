<?php

namespace App\Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    public function get(string $path, array|callable $handler)
    {
        $path = trim($path, '/');
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array|callable $handler)
    {
        $path = trim($path, '/');
        $this->routes['POST'][$path] = $handler;
    }

    public function put(string $path, array|callable $handler)
    {
        $path = trim($path, '/');
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete(string $path, array|callable $handler)
    {
        $path = trim($path, '/');
        $this->routes['DELETE'][$path] = $handler;
    }

    public function useRouter($path, $method)
    {
        // Get requested route from URL
        $route = preg_replace('/\?.*/', '', $path); // Strip query string from URL
        $route = trim($route, '/'); // Strip trailing slashes from URL

        // Check if route exists in routes array for the requested method
        foreach ($this->routes[$method] as $pattern => $handler) {
            // Get parameter name from pattern
            preg_match_all('/{([^}]+)}/', $pattern, $matches);
            if (!empty($matches[1])) {
                $paramName = $matches[1][0];

                // Replace parameter with regular expression for capturing parameter value
                $pattern = str_replace('{' . $paramName . '}', '(.+)', $pattern);
            }

            if (preg_match('#^' . $pattern . '$#', $route, $matches)) {
                if (is_callable($handler)) {
                    // If handler is a closure, call it with parameter value as argument
                    $handler($matches[1]);
                } else {
                    // If handler is an array containing controller class and method, call the method with parameter value as argument
                    $controller = $handler[0];
                    $method = $handler[1];
                    $controllerObj = new $controller();
                    $controllerObj->$method($matches[1]);
                }
                return;
            }
        }

        // handle 404
        abort(404, "Route `$method $path` Not Found");
    }



    public function getRoutes()
    {
        return $this->routes;
    }
}
