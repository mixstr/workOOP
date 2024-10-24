<?php

namespace app\core;

use DateTime;
use ReflectionClass;
use ReflectionProperty;

class RequestValidator
{
    private $request;
    private $format;

    public function __construct($request, $format = 'Y-m-d')
    {
        $this->request = $request;
        $this->format = $format;
    }

    public function validateMonth(array $request, string $method): mixed
    {
        switch ($method){
            case "insert":
                $name = $this->validateParam('name', 'string');
                $day = $this->validateParam('day', 'int');
                $month = $this->validateParam('month', 'float');
                $year = $this->validateParam('year', 'float');
        
                $values = array('name' => $name,'day' => $day,'month' => $month,'year' => $year);
                return $values;
            case "update":
                $id =  $this->validateInt('id', 'int');
                $name = $this->validateParam('name', 'string');
                $day = $this->validateParam('day', 'int');
                $month = $this->validateParam('month', 'float');
                $year = $this->validateParam('year', 'float');
        
                $values = array('id' => $id,'name' => $name,'day' => $day,'month' => $month,'year' => $year);
                return $values;
    }
    }

    public function validateController(array $request, string $method): mixed
    {
        switch ($method){
            case "insert":
                $employeeId = $this->validateInt('employee_id');
                $monthId = $this->validateInt('month_id');
                $coefficient = $this->validateParam('coefficient', 'float');
                
                $values = array('employee_id' => $employeeId,'month_id' => $monthId,'coefficient' => $coefficient);
                return $values;
            case "update":
                $id =  $this->validateInt('id');
                $employeeId = $this->validateParam('employee_id', 'int');
                $monthId = $this->validateParam('month_id', 'int');
                $coefficient = $this->validateParam('coefficient', 'float');
                
                $values = array('id' => $id,'employee_id' => $employeeId,'month_id' => $monthId,'coefficient' => $coefficient);
                return $values;
        }
    }

    public function validateEmployee(array $request, string $method): mixed
    {
        switch ($method){
            case "insert":
                $fio = $this->validateString('fio');
                $hireDate = $this->validateDate('hire_date');
                $terminationDate = $this->validateParam('termination_date', 'date');
                
                $values = array('fio' => $fio,'hire_date' => $hireDate,'termination_date' => $terminationDate);
                return $values;
            case "update":
                $id =  $this->validateInt('id');
                $fio = $this->validateString('fio');
                $hireDate = $this->validateParam('hire_date', 'date');
                $terminationDate = $this->validateParam('termination_date', 'date');

                $values = array('id' => $id,'fio' => $fio,'hire_date' => $hireDate,'termination_date' => $terminationDate);
                return $values;
        }
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

    public function validateParam(string $key,string $type): mixed
    {
        if (array_key_exists($key, $_REQUEST)) {
    
            if (is_null($_REQUEST[$key]) || strlen($_REQUEST[$key]) == 0)
                return NULL;
    
            switch($type){
                case 'int':
                    return $this->validateInt($key);
                case 'float':
                    return $this->validateFloat($key);
                case 'string':
                    return (string)$_REQUEST[$key];
                case 'date':
                    return $this->validateDate($key);
                default:
                    die();
            }
        }
        else {
            return NULL;
        }
    }

    public function processEntity(mixed $entities): void 
    {
        $answer = [];
        if (is_object($entities) === true){
            $dto = $entities->getEntityDtoObject();
            Router::createResponse(true, $dto);
        }else {
            foreach ($entities as $entity) {
                $dto = $entity->getEntityDtoObject();
                array_push($answer, $dto);
            }
            Router::createResponse(true, $answer);
        }
    }
}