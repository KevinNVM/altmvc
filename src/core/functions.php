<?php

if (!function_exists('dd') && !function_exists('dump')) {
    function dd()
    {
        foreach (func_get_args() as $arg) {
            sage($arg);
        }
        die;
    }
    function dump()
    {
        foreach (func_get_args() as $arg) {
            sage($arg);
        }
    }
}

if (!function_exists('send')) {
    function send(int $http_code = 200, string $message = '')
    {
        $env = $_ENV['ENVIRONMENT'];
        $error_messages = HTTP_ERROR_MESSAGES;

        if (isset($error_messages[$http_code])) {
            $default_message = $error_messages[$http_code];
        } else {
            $default_message = $error_messages[500];
        }


        $display_message = ($message !== '') ? $message : $default_message;

        echo $display_message;

        die;
    }
}


if (!function_exists('abort')) {
    function abort(int $http_code, string $message = '')
    {
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
