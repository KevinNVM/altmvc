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

                // Call handler with parameter values as arguments




                if (is_callable($handler)) {
                    $output = $handler(...$matches);
                    if (is_array($output)) {
                        header("Content-Type: application/json");
                        echo json_encode($output);
                    } else {
                        header("Content-Type: text/html");
                        echo $output;
                    }
                } else {
                    $controller = $handler[0];
                    $method = $handler[1];
                    $controllerObj = new $controller();

                    // Call the method on the object after creating the instance
                    $output = $controllerObj->$method();
                    if (is_array($output)) {
                        header("Content-Type: application/json");
                        echo json_encode($output);
                    } else {
                        header("Content-Type: text/html");
                        echo $output;
                    }
                }


                return;
            }
        }

        // handle 404 ROutes
        abort(404, "Route `$method $path` Not Found");
    }

    /**
     * Get all of the routes
     * 
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
