<?php

namespace app\service;

use Doctrine\ORM\EntityManager;
use app\entities\EmployeeEntity;
use app\core\Router;
use DateTime;

class EmployeeService
{
    public EntityManager $entityManager;
    public array $employees;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
    }

    public function selectAll(array $request): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findAll();
        $this->toAnswer($employees);
    }

    public function selectById(int $id): void
    {
        $employees = $this->entityManager->find('app\entities\EmployeeEntity', $id);
        $this->toAnswer($employees);
    }

    public function selectByFio(string $fio): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('fio' => $fio));
        $this->toAnswer($employees);
    }

    public function selectByHire(DateTime $hire_date): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('hire_date' => $hire_date));
        $this->toAnswer($employees);
    }

    public function selectByTermination(DateTime $termination_date): void
    {
        $employees = $this->entityManager->getRepository('app\entities\EmployeeEntity')->findBy(array('termination_date' => $termination_date));
        $this->toAnswer($employees);
    }

    public function insert(int $id, string $fio, DateTime $hire_date, ?DateTime $termination_date): void
    {
        $employeeEntity = new EmployeeEntity();

        $employeeEntity->setId($id)
        ->setFio($fio)
        ->setHireDate($hire_date);

        foreach ($termination_date as $value) {
            $employeeEntity->setTerminationDate($value);
        }

        $this->entityManager->persist($employeeEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(int $id, ?string $fio, ?DateTime $hire_date, ?DateTime $termination_date): void
    {
        $employeeEntity = $this->entityManager->find('app\entities\EmployeeEntity', $id);
        $employeeEntity->setFio($fio);

        foreach ($hire_date as $value) {
            $employeeEntity->setHireDate($value);
        }

        foreach ($termination_date as $value) {
            $employeeEntity->setTerminationDate($value);
        }

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

    public function toAnswer(mixed $objects): void{
        $answer = [];
        if (is_object($objects) === true){
            $array = [
                "id" => $objects->getId(),
                "fio" => $objects->getFio(),
                "hire_date" => $objects->getHireDate(),
                "termination_date" => $objects->getTerminationDate()
            ];
            Router::createResponse(true, $array);
        }else {
            foreach ($objects as $object){
                $array = [
                    "id" => $object->getId(),
                    "fio" => $object->getFio(),
                    "hire_date" => $object->getHireDate(),
                    "termination_date" => $object->getTerminationDate()
                ];
                array_push($answer, $array);
                }
                Router::createResponse(true, $answer);
        }
    }
}


