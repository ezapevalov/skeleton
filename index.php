<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APP_ROOT', __DIR__);

// server should keep session data for AT LEAST 1 week
ini_set('session.gc_maxlifetime', 604800);

// each client should remember their session id for EXACTLY 1 week
session_set_cookie_params(604800);

ini_set('session.cookie_httponly', 1);
ini_set('session.name', '_cnsc');
session_start();

// composer autoload
require_once "vendor/autoload.php";

// main app class
require_once "app.php";

try {
    $app = App::factory();
    $app->run();
} catch ( Exception $e ) {
    echo "<h1>" . $e->getMessage() . "</h1>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}