<?php

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
