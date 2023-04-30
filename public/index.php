<?php 

if (isset($_SERVER['SCRIPT_FILENAME']) && basename($_SERVER['SCRIPT_FILENAME']) === 'cli') {
    header('HTTP/1.0 403 Forbidden');
    exit('Forbidden');
}


try {
    require '../src/core/autoload.php';
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "Internal Server Error";
    exit();
}

// Run routes to simulate controllers
require '../src/routes.php';

?>
