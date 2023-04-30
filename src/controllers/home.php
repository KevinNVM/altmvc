<?php

// Controller for default routes

function home() {
     view('home.php', [
        'app_name' => $_ENV['APP_NAME'],
        'framework_version' => $_ENV['VERSION'],
        'php_version' => PHP_VERSION
    ]);
}

function about() {
     view('about.php');
}

// return [
//     'home' => fn() => home(),
//     'about' => fn() => about()
// ];