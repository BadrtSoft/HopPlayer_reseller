<?php

/*
|--------------------------------------------------------------------------
| Leaf MVC
|--------------------------------------------------------------------------
|
| Leaf MVC is a minimal but powerful PHP MVC framework based on
| the Leaf PHP framework.
|
| This file allows us to run the app from the root of the project.
| This provides a convenient way to test your Leaf MVC app
| without having installed a "real" web server software here.
|
| It also allows you to directly load up your application from
| the root file for quickly hosting on shared hosting platforms.
|
*/


// report all errors
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

define('APP_NAME', "SamTv Player");

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
