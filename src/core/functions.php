<?php

// core functions
if (!function_exists('view')) {
    function view(string $path, $data = []) {
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
            include $path;
        } else {
            abort(404, "View file '$path' not found");
        }
    }
}


if (!function_exists('send')) {
    function send($callback = null) {
        $args = func_get_args();
    
        if ($callback && is_callable($callback)) {
            $callback_result = call_user_func($callback);
            if ($callback_result) {
                $args = array($callback_result);
            }
        }
    
        foreach ($args as $arg) {
            if (is_string($arg)) {
                echo $arg;
            } else {
                echo json_encode($arg);
            }
        }
    
        die;
    }
}

if (!function_exists('abort')) {
    function abort(int|string $http_code, string $message = '') {
        $env = $_ENV['ENVIRONMENT'];
        $error_messages = HTTP_ERROR_MESSAGES;
    
        if (isset($error_messages[$http_code])) {
            $default_message = $error_messages[$http_code];
        } else {
            $default_message = $error_messages[500];
        }
    
        $display_message = ($message !== '') ? $message : $default_message;
    
        if ($env !== 'production') {
            // If in development or other non-production environment, display the error message
            header("HTTP/1.1 $http_code $default_message");
            throw new Exception($display_message, $http_code);
        } else {
            // If in production environment, send the error message and appropriate HTTP code
            header("HTTP/1.1 $http_code $default_message");
            echo $default_message;
        }
    
        die;
    }
    
}

if (!function_exists('dd')) {
    function dd() {
        ob_start();
    var_dump(func_get_args());
    $dump = ob_get_clean();
    $dump = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $dump);
    $dump = '<pre>' . $dump . '</pre>';
    echo $dump;
    die;
    }
}

if (!function_exists('dump')) {
    function dump() {
        ob_start();
    var_dump(func_get_args());
    $dump = ob_get_clean();
    $dump = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $dump);
    $dump = '<pre>' . $dump . '</pre>';
    echo $dump;
    }
}