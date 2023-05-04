<?php

namespace App\Core\Errors\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'View Not Found';
}
