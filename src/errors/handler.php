<?php


function handle_error($error) {
    $error_message = '';
    $code = $error['type'];
    $file = $error['file'];
    $line = $error['line'];
    $trace = $error['trace'];

    $title = '';
    switch ($code) {
        case E_USER_ERROR:
            $title = 'Fatal Error';
            break;
        case E_USER_WARNING:
            $title = 'Warning';
            break;
        case E_USER_NOTICE:
            $title = 'Notice';
            break;
        default:
            $title = 'Error';
            break;
    }

    ob_start();
    require __DIR__ . '/error.php';
    $content = ob_get_clean();
    echo $content;
}

function handle_exception($exception) {
    $error_message = 'Uncaught Exception';
    $code = $exception->getCode();
    $file = $exception->getFile();
    $line = $exception->getLine();
    $trace = $exception->getTraceAsString();

    ob_start();
    require __DIR__ . '/exception.php';
    $content = ob_get_clean();
    echo $content;
}


set_error_handler(function($code, $message, $file, $line) {
    handle_error([
        'type' => $code,
        'message' => $message,
        'file' => $file,
        'line' => $line,
        'trace' => debug_backtrace(),
    ]);
});

set_exception_handler(function($exception) {
    handle_exception($exception);
});


