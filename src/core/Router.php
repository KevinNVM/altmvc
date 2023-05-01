<?php

namespace App\Core;

class Router
{
    // Array to hold routes and their corresponding controller methods
    private array $routes = [];

    /*
    * This method adds a GET route to the routes array.
    * @param string $path The path for the route.
    * @param array $controller An array containing the controller class name and method name.
    * @return void
    */
    public function get(string $path, array $controller)
    {
        // Remove any trailing slashes from the path.
        $path = trim($path, '/');

        // Add the route to the routes array.
        $this->routes['GET'][$path] = $controller;
    }

    /*
    * This method adds a POST route to the routes array.
    * @param string $path The path for the route.
    * @param array $controller An array containing the controller class name and method name.
    * @return void
    */
    public function post(string $path, array $controller)
    {
        // Remove any trailing slashes from the path.
        $path = trim($path, '/');

        // Add the route to the routes array.
        $this->routes['POST'][$path] = $controller;
    }

    /*
    * This method adds a PUT route to the routes array.
    * @param string $path The path for the route.
    * @param array $controller An array containing the controller class name and method name.
    * @return void
    */
    public function put(string $path, array $controller)
    {
        // Remove any trailing slashes from the path.
        $path = trim($path, '/');

        // Add the route to the routes array.
        $this->routes['PUT'][$path] = $controller;
    }

    /*
    * This method adds a PATCH route to the routes array.
    * @param string $path The path for the route.
    * @param array $controller An array containing the controller class name and method name.
    * @return void
    */
    public function patch(string $path, array $controller)
    {
        // Remove any trailing slashes from the path.
        $path = trim($path, '/');

        // Add the route to the routes array.
        $this->routes['PATCH'][$path] = $controller;
    }

    /*
    * This method adds a DELETE route to the routes array.
    * @param string $path The path for the route.
    * @param array $controller An array containing the controller class name and method name.
    * @return void
    */
    public function delete(string $path, array $controller)
    {
        // Remove any trailing slashes from the path.
        $path = trim($path, '/');

        // Add the route to the routes array.
        $this->routes['DELETE'][$path] = $controller;
    }

    /*
* This method handles incoming requests and dispatches them to the appropriate controller method.
* @param string $path The path of the requested resource.
* @param string $method The HTTP method of the request.
* @return void
*/
    public function useRouter(string $path, string $method)
    {
        // Get requested route from URL
        $route = preg_replace('/\?.*/', '', $path); // Strip query string from URL
        $route = trim($route, '/'); // Strip trailing slashes from URL

        // Check if route exists in routes array
        foreach ($this->routes[$method] as $pattern => $handler) {
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

        // Handle 404 error if route not found.
        abort(404, "Route `$path` with method `$method` Not Found");
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
