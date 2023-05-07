<?php

// Require composer autoload
require '../vendor/autoload.php';

// Get the instances of app 
$app = require '../src/App/bootstrap.php';

// Run the app on requests
$app->run();
