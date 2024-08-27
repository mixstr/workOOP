<?php

namespace app\controller;

use app\service\MonthService;
use app\core\RequestValidator;
use app\entities\MonthEntity;
use Doctrine\ORM\EntityManager;

class MonthController
{
    public $validator;
    private MonthService $monthService;
    public EntityManager $entityManager;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
        $this->validator = new RequestValidator($_REQUEST);
        $this->monthService = new MonthService();
    }

    public function selectAll(array $request): void
    {
        $this->monthService->selectAll($request);
    }

    public function selectById(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->monthService->selectById($id);
    }
    
    public function selectByName(array $request): void
    {
        $name = $this->validator->validateString('name');
        $this->monthService->selectByName($name);
    }

    public function selectByDay(array $request): void
    {
        $day = $this->validator->validateInt('day');
        $this->monthService->selectByDay($day);
    }
    
    public function selectByMonth(array $request): void
    {
        $monthID = $this->validator->validateInt('month');
        $this->monthService->selectByMonth($monthID);
    }

    public function selectByYear(array $request): void
    {
        $year = $this->validator->validateInt('year');
        $this->monthService->selectByYear($year);
    }

    public function insert(array $request): void
    {
        $id =  $this->validator->validateInt('id', 'int');
        $name = $this->validator->validateParam('name', 'string');
        $day = $this->validator->validateParam('day', 'int');
        $month = $this->validator->validateParam('month', 'float');
        $year = $this->validator->validateParam('year', 'float');
        $this->monthService->insert($id, $name, $day, $month, $year);
    }
    public function update(array $request): void
    {
        $id =  $this->validator->validateInt('id', 'int');
        $name = $this->validator->validateParam('name', 'string');
        $day = $this->validator->validateParam('day', 'int');
        $month = $this->validator->validateParam('month', 'float');
        $year = $this->validator->validateParam('year', 'float');
        $this->monthService->update($id, $name, $day, $month, $year);
    }

    public function delete(array $request): void
    {
        $id = $this->validator->validateInt('id');
        $this->monthService->delete($id);
    }

}