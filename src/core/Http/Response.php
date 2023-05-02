<?php

namespace App\Core\Http;

class Response
{
    static public function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    static public function view(string $pathOrHtmlString, array $data = [], ?bool $forceRender = false)
    {
        $path = $pathOrHtmlString;
        $path = VIEWS_PATH . $path;
        if (file_exists($path)) {
            extract($data);
            foreach ($data as $key => $value) {
                if (strpos($key, '-') !== false || strpos($key, ' ') !== false) {
                    $newKey = str_replace(['-', ' '], '_', $key);
                    ${$newKey} = $value;
                    unset(${$key});
                }
            }
            header('Content-Type: text/html');
            ob_clean();
            @include($path); # Supress the exception if not found
        } elseif ($forceRender) {
            header('Content-Type: text/html');
            ob_clean();
            echo $pathOrHtmlString;
        } else {
            abort(404, "View file '$path' not found");
        }
    }
}
