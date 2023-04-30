<?php

# Framework
$_ENV['ENVIRONMENT'] = 'local'; // local|production
$_ENV['VERSION'] = '1.0.0';

# Application
$_ENV['APP_NAME'] = 'AltMVC';
$_ENV['APP_URL'] = 'https://localhost:8000';

# Database
$_ENV['DB_NAME'] = strtolower($_ENV['APP_NAME']);
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_USER'] = 'root';
$_ENV['DB_PASS'] = '';