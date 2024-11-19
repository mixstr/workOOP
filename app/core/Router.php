<?php 

namespace app\core;

use Error;

class Router{

    public $method;

    public function __construct() {
        $this->validAct();
    }

    private function validAct(): void
    {
            $act = $_REQUEST["act"];
            $method = $_REQUEST["method"];
            $class = "app\\controller\\" . ucfirst($act) . "Controller";
            $controller = new $class();
            $controller->$method($_REQUEST);
    }

    public static function createResponse($success, $rows): void
    {
        echo json_encode([
            "success" => $success, 
            "rows" => $rows
        ]);
    }
}