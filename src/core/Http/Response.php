<?php

namespace App\Core\Http;

class Response
{
    /*
    * This method sends a JSON response back to the client.
    *
    * @param array $data The data to be encoded as JSON.
    * @return void
    */
    static public function json($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /*
    * This method renders a view with optional data.
    *
    * @param string $path The path to the view file.
    * @param array $data Optional data to be passed to the view.
    * @return void
    */
    static public function view(string $path, array $data = []): void
    {
        // Append the views path to the given path.
        $path = VIEWS_PATH . $path;

        // Check if the view file exists.
        if (file_exists($path)) {
            // Extract the data and create variables for each key.
            extract($data);
            foreach ($data as $key => $value) {
                if (strpos($key, '-') !== false || strpos($key, ' ') !== false) {
                    $newKey = str_replace(['-', ' '], '_', $key);
                    ${$newKey} = $value;
                    unset(${$key});
                }
            }

            // Set the content type to HTML and render the view.
            header('Content-Type: text/html');
            ob_clean();
            require $path;
        } else {
            // Throw a 404 error if the view file does not exist.
            abort(404, "View file '$path' not found");
        }
    }
}
