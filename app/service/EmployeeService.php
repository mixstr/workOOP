<?php

namespace app\service;

use app\core\RequestValidator;
use Doctrine\ORM\EntityManager;
use app\entities\EmployeeEntity;
use app\core\Router;
use DateTime;

class EmployeeService
{
    public EntityManager $entityManager;
    public $validator;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
        $this->validator = new RequestValidator($_REQUEST);
    }

    public function selectAll(array $request): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findAll();
        $this->validator->processEntity($employees);
    }

    public function selectById(int $id): void
    {
        $employees = $this->entityManager->find('app\entities\EmployeeEntity', $id);
        $this->validator->processEntity($employees);
    }

    public function selectByFio(string $fio): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('fio' => $fio));
        $this->validator->processEntity($employees);
    }

    public function selectByHire(DateTime $hireDate): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('hireDate' => $hireDate));
        $this->validator->processEntity($employees);
    }

    public function selectByTermination(DateTime $terminationDate): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('terminationDate' => $terminationDate));
        $this->validator->processEntity($employees);
    }

    public function insert(array $values): void
    {
        $employeeEntity = new EmployeeEntity();

        $employeeEntity->setFio($values['fio'])
        ->setHireDate($values['hire_date'])
        ->setTerminationDate($values['termination_date']);

        $this->entityManager->persist($employeeEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(array $values): void
    {
        $employeeEntity = $this->entityManager->find('app\entities\EmployeeEntity', $values['id']);
        $employeeEntity->setFio($values['fio'])
        ->setHireDate($values['hire_date'])
        ->setTerminationDate($values['termination_date']);

        $this->entityManager->flush();

        Router::createResponse(true, null);
    }
    public function delete(int $id): void
    {
        $employeeEntity = $this->entityManager->find('app\entities\EmployeeEntity', $id);
        $this->entityManager->remove($employeeEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }
}


