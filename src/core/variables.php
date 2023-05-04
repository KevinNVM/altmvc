<?php

define('VIEWS_PATH', '../src/Views/');
define('VIEWS_LAYOUT_PATH', '../src/Views/layouts/');
define('DEFAULT_LAYOUT_PATH', '/main/app');

define('HTTP_ERROR_MESSAGES',  array(
    200 => 'OK',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    413 => 'Payload Too Large',
    414 => 'URI Too Long',
    415 => 'Unsupported Media Type',
    429 => 'Too Many Requests',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout'
));
