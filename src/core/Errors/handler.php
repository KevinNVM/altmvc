<?php

/*
    This function handles errors
    @param $errno int, error type
    @param $errstr string, error message
    @param $errfile string, file in which error occurred
    @param $errline int, line number of error
    @return void
*/
function handle_error($errno, $errstr, $errfile, $errline)
{
    http_response_code(500);
    $title = "Error";
    $error_message = "An error occurred.";
    $file = $errfile;
    $line = $errline;
    $trace = debug_backtrace();
    include "views.php";
    exit;
}

/**
 * This function handles exceptions
    @param $exception Exception object, the exception object that was thrown
    @return void
 */
function handle_exception($exception)
{
    http_response_code(500);
    $title = "Exception";
    $error_message = $exception->getMessage();
    $file = $exception->getFile();
    $line = $exception->getLine();
    $trace = $exception->getTrace();
    include "views.php";
    exit;
}



// Register error handler
set_error_handler(function ($code, $message, $file, $line) {
    ob_clean(); // Clear the output buffer
    handle_error($code, $message, $file, $line);
});

// Register exception handler
set_exception_handler(function ($exception) {
    ob_clean(); // Clear the output buffer
    handle_exception($exception);
});
