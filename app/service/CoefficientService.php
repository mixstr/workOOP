<?php

namespace app\service;

use Doctrine\ORM\EntityManager;
use app\entities\CoefficientEntity;
use app\core\Router;

class CoefficientService
{
    public EntityManager $entityManager;
    public array $coefficients;

    public function __construct()
    {
        require_once "bootstrap.php";
        $this->entityManager = callEntityManager();
    }

    public function selectAll(array $request): void
    {
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findAll();
        $this->toAnswer($coefficients);
    }

    public function selectById(int $id): void
    {
        $coefficients = $this->entityManager->find('app\entities\CoefficientEntity', $id);
        $this->toAnswer($coefficients);
    }

    public function selectByEmployee(int $employee_id): void
    {
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findBy(array('employee_id' => $employee_id));
        $this->toAnswer($coefficients);
    }

    public function selectByMonth(int $month_id): void
    {
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findBy(array('month_id' => $month_id));
        $this->toAnswer($coefficients);
    }

    public function insert(int $id, int $employee_id, int $month_id, ?float $coefficient): void
    {
        $coefficientEntity = new CoefficientEntity();

        $coefficientEntity->setId($id)
        ->setEmployee($employee_id)
        ->setMonth($month_id);

        foreach ($coefficient as $value) {
            $coefficientEntity->setCoefficient($value);
        }

        $this->entityManager->persist($coefficientEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(int $id, ?int $employee_id, ?int $month_id, ?float $coefficient): void
    {
        $coefficientEntity = $this->entityManager->find('app\entities\CoefficientEntity', $id);
        foreach ($employee_id as $value) {
            $coefficientEntity->setEmployee($value);
        }
        
        foreach ($month_id as $value) {
            $coefficientEntity->setMonth($value);
        }
    
        foreach ($coefficient as $value) {
            $coefficientEntity->setCoefficient($value);
        }

        $this->entityManager->flush();
        
        Router::createResponse(true, null);
    }
    public function delete(int $id): void
    {
        $coefficientEntity = $this->entityManager->find('app\entities\CoefficientEntity', $id);
        $this->entityManager->remove($coefficientEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function toAnswer(mixed $objects): void
    {
        $answer = [];
        if (is_object($objects) === true){
            $array = [
                "id" => $objects->getId(),
                "employee_id" => $objects->getEmployee(),
                "month_id" => $objects->getMonth(),
                "coefficient" => $objects->getCoefficient()
            ];
            Router::createResponse(true, $array);
        }else {
            foreach ($objects as $object){
                $array = [
                    "id" => $object->getId(),
                    "employee_id" => $object->getEmployee(),
                    "month_id" => $object->getMonth(),
                    "coefficient" => $object->getCoefficient()
                ];
                array_push($answer, $array);
                }
                Router::createResponse(true, $answer);
        }
    }
}