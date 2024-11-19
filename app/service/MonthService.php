<?php

namespace app\service;

use app\core\RequestValidator;
use Doctrine\ORM\EntityManager;
use app\entities\MonthEntity;
use app\core\Router;

require_once "bootstrap.php";

class MonthService
{
    public EntityManager $entityManager;
    public $validator;

    public function __construct()
    {
        $this->entityManager = callEntityManager();
        $this->validator = new RequestValidator($_REQUEST);
    }

    public function selectAll(array $request): void
    {
        try {
            $months = $this->entityManager->getRepository(MonthEntity::class)->findAll();
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectById(int $id): void
    {
        try {
            $months = $this->entityManager->find(MonthEntity::class, $id);
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByName(string $name): void
    {
        try {
            $months = $this->entityManager->getRepository(MonthEntity::class)->findBy(['name' => $name]);
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByDay(int $day): void
    {
        try {
            $months = $this->entityManager->getRepository(MonthEntity::class)->findBy(['day' => $day]);
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByMonth(int $monthID): void
    {
        try {
            $months = $this->entityManager->getRepository(MonthEntity::class)->findBy(['month' => $monthID]);
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function selectByYear(int $year): void
    {
        try {
            $months = $this->entityManager->getRepository(MonthEntity::class)->findBy(['year' => $year]);
            $this->validator->processEntity($months);
        } catch (\Error $e) {
            Router::createResponse(false, $e->getMessage());
            die();
        }
    }

    public function insert(array $values): void
    {
        try {
            $monthEntity = new MonthEntity();
            $monthEntity->setName($values['name'])
            ->setDay($values['day'])
            ->setMonth($values['month'])
            ->setYear($values['year']);
    
            $this->entityManager->persist($monthEntity);
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
            $monthEntity = $this->entityManager->find(MonthEntity::class, $values['id']);
            if (!$monthEntity) {
                throw new \Exception();
            }
            $monthEntity->setName($values['name'])
            ->setDay($values['day'])
            ->setMonth($values['month'])
            ->setYear($values['year']);
    
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
            $monthEntity = $this->entityManager->find(MonthEntity::class, $id);
            if (!$monthEntity) {
                throw new \Exception();
            }
            $this->entityManager->remove($monthEntity);
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