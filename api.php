<?php

require_once "vendor/autoload.php";

use app\core\Router;

register_shutdown_function(function(){
    if (error_get_last()) {
      var_export(error_get_last());
    }
  });

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/" . str_replace("\\", "/", "{$class}.php");
    if (file_exists($file)) {
        require_once $file;
    }

});
$router = new Router;
