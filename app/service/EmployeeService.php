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
        try {
            $employees = $this->entityManager->getRepository(EmployeeEntity::class)->findAll();
            $this->validator->processEntity($employees);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectById(int $id): void
    {
        try {
            $employees = $this->entityManager->find(EmployeeEntity::class, $id);
            $this->validator->processEntity($employees);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByFio(string $fio): void
    {
        try {
            $employees = $this->entityManager->getRepository(EmployeeEntity::class)->findBy(['fio' => $fio]);
            $this->validator->processEntity($employees);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByHire(DateTime $hireDate): void
    {
        try {
            $employees = $this->entityManager->getRepository(EmployeeEntity::class)->findBy(['hireDate' => $hireDate]);
            $this->validator->processEntity($employees);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByTermination(DateTime $terminationDate): void
    {
        try {
            $employees = $this->entityManager->getRepository(EmployeeEntity::class)->findBy(['terminationDate' => $terminationDate]);
            $this->validator->processEntity($employees);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function insert(array $values): void
    {
        try {
            $employeeEntity = new EmployeeEntity();
            $employeeEntity->setFio($values['fio'])
            ->setHireDate($values['hireDate'])
            ->setTerminationDate($values['terminationDate']);
    
            $this->entityManager->persist($employeeEntity);
            $this->entityManager->flush();
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }

        Router::createResponse(true, null);
    }

    public function update(array $values): void
    {
        try {
            $employeeEntity = $this->entityManager->find(EmployeeEntity::class, $values['id']);
            if (!$employeeEntity) {
                throw new \Exception();
            }
            $employeeEntity->setFio($values['fio'])
            ->setHireDate($values['hireDate'])
            ->setTerminationDate($values['terminationDate']);
    
            $this->entityManager->flush();
        } catch (\Exception $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }

        Router::createResponse(true, null);
    }
    public function delete(int $id): void
    {
        try {
            $employeeEntity = $this->entityManager->find(EmployeeEntity::class, $id);
            if (!$employeeEntity) {
                throw new \Exception();
            }
            $this->entityManager->remove($employeeEntity);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }

        Router::createResponse(true, null);
    }
}


