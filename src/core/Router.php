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

    public function get(string $path, array|callable $handler): self
    {
        $path = trim($path, '/');
        $this->routes['GET'][$path] = $handler;
        return $this;
    }

    public function post(string $path, array|callable $handler): self
    {
        $path = trim($path, '/');
        $this->routes['POST'][$path] = $handler;
        return $this;
    }

    public function put(string $path, array|callable $handler): self
    {
        $path = trim($path, '/');
        $this->routes['PUT'][$path] = $handler;
        return $this;
    }

    public function delete(string $path, array|callable $handler): self
    {
        $path = trim($path, '/');
        $this->routes['DELETE'][$path] = $handler;
        return $this;
    }

    public function useRouter(string $path, string  $method): void
    {
        if (!in_array(strtoupper($method), ['GET', 'POST', 'PUT', 'DELETE']) && empty($path)) {
            throw new \Exception('Invalid Parameters!');
        }

        // Get requested route from URL
        $route = preg_replace('/\?.*/', '', $path); // Strip query string from URL
        $route = trim($route, '/'); // Strip trailing slashes from URL

        // Check if route exists in routes array for the requested method
        foreach ($this->routes[$method] as $pattern => $handler) {
            // Test if route matches pattern
            $regex = str_replace('/', '\/', $pattern);
            $regex = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_]+)', $regex);
            $regex = '/^' . $regex . '$/';
            if (preg_match($regex, $route, $matches)) {
                // Remove first element of $matches array, which contains the entire match
                array_shift($matches);

                // Determine number of parameters in the route
                $numParams = substr_count($pattern, '{');

                // Call handler with parameter values as arguments
                // Call handler with parameter values as arguments
                if (is_callable($handler)) {
                    switch ($numParams) {
                        case 0:
                            $handler();
                            break;
                        default:
                            $handler(...$matches);
                            break;
                    }
                } else {
                    $controller = $handler[0];
                    $method = $handler[1];
                    $controllerObj = new $controller();
                    switch ($numParams) {
                        case 0:
                            $controllerObj->$method();
                            break;
                        default:
                            $handler(...$matches);
                            break;
                    }
                }

                return;
            }
        }

        // handle 404
        abort(404, "Route `$method $path` Not Found");
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
