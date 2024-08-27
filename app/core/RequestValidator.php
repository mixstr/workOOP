<?php

namespace app\core;

use DateTime;

class RequestValidator
{
    private $request;
    private $format;

    public function __construct($request, $format = 'Y-m-d')
    {
        $this->request = $request;
        $this->format = $format;
    }

    public function validateInt(string $key): int
    {
        if (isset($this->request[$key])) {
            $value = $this->request[$key];
            if (is_numeric($value) && intval($value) == $value) {
                return intval($value);
            }
        }
            http_response_code(400);
            echo "Invalid type of value: " . $key;
            die();
    }

    public function validateFloat(string $key): float
    {
        if (isset($this->request[$key])) {
            $value = $this->request[$key];
            if (is_numeric($value)) {
                return (float)$value;
            }
        }
            http_response_code(400);
            echo "Invalid type of value: " . $key;
            die();
    }

    public function validateString(string $key): string
    {
        if (isset($this->request[$key])) {
            return $_REQUEST[$key];
        }
            http_response_code(400);
            echo "Invalid type of value: " . $key;
            die();
    }

    public function validateDate(string $key): DateTime
    {
        if (isset($this->request[$key])) {
            $dateTime = DateTime::createFromFormat($this->format, $_REQUEST[$key]);
            if ($dateTime === false) {
                echo ("Не удалось преобразовать строку в дату.");
            }
            return $dateTime;
        }
            http_response_code(400);
            echo "Invalid type of value: " . $key;
            die();
    }

    public function validateParam(string $key,string $type): array
    {
        if (array_key_exists($key, $_REQUEST)) {
    
            if (is_null($_REQUEST[$key]) || strlen($_REQUEST[$key]) == 0)
                return [null];
    
            switch($type){
                case 'int':
                    return [$this->validateInt($key)];
                case 'float':
                    return [$this->validateFloat($key)];
                case 'string':
                    return [(string)$_REQUEST[$key]];
                case 'date':
                    return [$this->validateDate($key)];
                default:
                    die();
            }
        }
        else {
            return array();
        }
    }
}