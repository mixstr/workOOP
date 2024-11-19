<?php

namespace app\controller;

use app\service\EmployeeService;
use app\core\RequestValidator;
use app\entities\EmployeeEntity;
use Doctrine\ORM\EntityManager;

class EmployeeController
{
    public $validator;
    private EmployeeService $employeeService;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->validator = new RequestValidator($_REQUEST);
        $this->employeeService = new EmployeeService();
    }

    public function selectAll(array $request): void
    {
        $this->employeeService->selectAll($request);
    }

    public function selectById(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->employeeService->selectById($id);
    }

    public function selectByFio(array $request): void
    {
        $fio = $this->validator->validateString('fio');
        $this->employeeService->selectByFio($fio);
    }
    
    public function selectByHire(array $request): void
    {
        $hireDate = $this->validator->validateParam('hireDate', 'date');
        foreach ($hireDate as $date)
        {
            $this->employeeService->selectByHire($date);
        }
    }
    
    public function selectByTermination(array $request): void
    {
        $terminationDate = $this->validator->validateParam('terminationDate', 'date');
        foreach ($terminationDate as $date)
        {
            $this->employeeService->selectByTermination($date);
        }
    }

    public function insert(array $request): void
    {
        $values = $this->validator->validateEmployee($request, 'insert');
        $this->employeeService->insert($values);
    }
    public function update(array $request): void
    {
        $values = $this->validator->validateEmployee($request, 'update');
        $this->employeeService->update($values);
    }

    public function delete(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->employeeService->delete($id);
    }
}