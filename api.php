<?php

require_once "vendor/autoload.php";

use app\core\Router;

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/" . str_replace("\\", "/", "{$class}.php");
    if (file_exists($file)) {
        require_once $file;
    }

});
$router = new Router;
