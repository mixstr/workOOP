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
        try {
            $coefficients = $this->entityManager->getRepository(CoefficientEntity::class)->findAll();
            $this->validator->processEntity($coefficients);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectById(int $id): void
    {
        try {
            $coefficients = $this->entityManager->find(CoefficientEntity::class, $id);
            $this->validator->processEntity($coefficients);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByEmployee(int $employeeId): void
    {
        try {
            $coefficients = $this->entityManager->getRepository(CoefficientEntity::class)->findBy(['employeeId' => $employeeId]);
            $this->validator->processEntity($coefficients);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByMonth(int $monthId): void
    {
        try {
            $coefficients = $this->entityManager->getRepository(CoefficientEntity::class)->findBy(['monthId' => $monthId]);
            $this->validator->processEntity($coefficients);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function insert(array $values): void
    {
        try {
            $coefficientEntity = new CoefficientEntity();
            $coefficientEntity->setEmployee($values['employeeId'])
        ->setMonth($values['monthId'])
        ->setCoefficient($values['coefficient']);

        $this->entityManager->persist($coefficientEntity);
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
            $coefficientEntity = $this->entityManager->find(CoefficientEntity::class, $values['id']);
            if (!$coefficientEntity) {
                throw new \Exception();
            }
            $coefficientEntity->setEmployee($values['employeeId'])
            ->setMonth($values['monthId'])
            ->setCoefficient($values['coefficient']);
    
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
            $coefficientEntity = $this->entityManager->find(CoefficientEntity::class, $id);
            if (!$coefficientEntity) {
                throw new \Exception();
            }
            $this->entityManager->remove($coefficientEntity);
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