<?php

namespace app\controller;

use app\service\CoefficientService;
use app\core\RequestValidator;
use app\entities\CoefficientEntity;
use Doctrine\ORM\EntityManager;

class CoefficientController
{
    public $validator;
    private CoefficientService $coefficientService;
    public EntityManager $entityManager;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
        $this->validator = new RequestValidator($_REQUEST);
        $this->coefficientService = new CoefficientService();
    }

    public function selectAll(array $request): void
    {
        $this->coefficientService->selectAll($request);
    }

    public function selectById(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->coefficientService->selectById($id);
    }
    
    public function selectByEmployee(array $request): void
    {
        $employeeId = $this->validator->validateInt('employeeId');
        $this->coefficientService->selectByEmployee($employeeId);
    }
    
    public function selectByMonth(array $request): void
    {
        $monthId = $this->validator->validateInt('monthId');
        $this->coefficientService->selectByMonth($monthId);
    }

    public function insert(array $request): void
    {
        $values = $this->validator->validateController($request, 'insert');
        $this->coefficientService->insert($values);
    }
    public function update(array $request): void
    {
        $values = $this->validator->validateController($request, 'update');
        $this->coefficientService->update($values);
    }

    public function delete(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->coefficientService->delete($id);
    }
}