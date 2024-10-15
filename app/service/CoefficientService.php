<?php

namespace app\service;

use app\core\RequestValidator;
use Doctrine\ORM\EntityManager;
use app\entities\CoefficientEntity;
use app\core\Router;

class CoefficientService
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
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findAll();
        $this->validator->processEntity($coefficients);
    }

    public function selectById(int $id): void
    {
        $coefficients = $this->entityManager->find('app\entities\CoefficientEntity', $id);
        $this->validator->processEntity($coefficients);
    }

    public function selectByEmployee(int $employeeId): void
    {
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findBy(array('employeeId' => $employeeId));
        $this->validator->processEntity($coefficients);
    }

    public function selectByMonth(int $monthId): void
    {
        $coefficients = $this->entityManager->getRepository('app\entities\CoefficientEntity')->findBy(array('monthId' => $monthId));
        $this->validator->processEntity($coefficients);
    }

    public function insert(array $values): void
    {
        $coefficientEntity = new CoefficientEntity();

        $coefficientEntity->setEmployee($values['employee_id'])
        ->setMonth($values['month_id'])
        ->setCoefficient($values['coefficient']);

        $this->entityManager->persist($coefficientEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(array $values): void
    {
        $coefficientEntity = $this->entityManager->find('app\entities\CoefficientEntity', $values['id']);
        
        $coefficientEntity->setEmployee($values['employee_id'])
        ->setMonth($values['month_id'])
        ->setCoefficient($values['coefficient']);

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
}