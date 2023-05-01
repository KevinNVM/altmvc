<?php

/*

*   This file includes required files, sets up the environment, and detects if the server is running using AltMVC serve command.
*   If the server is not running using serve command and the environment is not set to production, it displays a warning message.

*   Files required:
*   1.  core/errors/handler.php - a file that contains a custom error handler function
*   2.  ../env - a file that contains environment variables
*   3.  core/variables.php - a file that contains global variables
*   4.  core/functions.php - a file that contains helper functions
*   5.  routes/Routes.php - a file that defines the routes for the application

*   $path - a variable that contains the current request URI
*   $usingAltServe - a boolean variable that indicates whether the server is running using AltMVC serve command or not

*   If the $usingAltServe variable is false and the environment is not set to production, a warning message is displayed. 
*/

require __DIR__ . '/core/errors/handler.php';
require __DIR__ . '/../env';
require __DIR__ . '/core/variables.php';
require __DIR__ . '/core/functions.php';
require __DIR__ . '/routes/Routes.php';

$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$usingAltServe = !strpos($path, "/public") && !strpos($path, "public");

if (!$usingAltServe && $_ENV['ENVIRONMENT'] !== 'production') echo "<b>Warning</b>: AltMVC detect that your urls
contains <code>/public</code>! If you are not running AltMVC using <code>serve</code> command, certain functionality
might not work.<br>
<p>This warning will not appear on production mode.</p>
<hr />";
