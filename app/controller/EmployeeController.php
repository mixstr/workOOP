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
    public EntityManager $entityManager;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
        $this->validator = new RequestValidator($_REQUEST);
        $this->employeeService = new EmployeeService();
    }

    public function selectAll(array $request): array
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
        $hire_date = $this->validator->validateParam('hire_date', 'date');
        foreach ($hire_date as $date)
        {
            $this->employeeService->selectByHire($date);
        }
    }
    
    public function selectByTermination(array $request): void
    {
        $termination_date = $this->validator->validateParam('termination_date', 'date');
        foreach ($termination_date as $date)
        {
            $this->employeeService->selectByTermination($date);
        }
    }

    public function insert(array $request): void
    {
        $id =  $this->validator->validateInt('id');
        $fio = $this->validator->validateString('fio');
        $hire_date = $this->validator->validateDate('hire_date');
        $termination_date = $this->validator->validateParam('termination_date', 'date');
        $this->employeeService->insert($id, $fio, $hire_date, $termination_date);
    }
    public function update(array $request): void
    {
        $id =  $this->validator->validateInt('id');
        $fio = $this->validator->validateString('fio');
        $hire_date = $this->validator->validateParam('hire_date', 'date');
        $termination_date = $this->validator->validateParam('termination_date', 'date');
        $this->employeeService->update($id, $fio, $hire_date, $termination_date);
    }

    public function delete(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->employeeService->delete($id);
    }
}