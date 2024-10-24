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
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findAll();
        $this->validator->processEntity($months);
    }

    public function selectById(int $id): void
    {
        $months = $this->entityManager->find('app\entities\MonthEntity', $id);
        $this->validator->processEntity($months);
    }

    public function selectByName(string $name): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('name' => $name));
        $this->validator->processEntity($months);
    }

    public function selectByDay(int $day): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('day' => $day));
        $this->validator->processEntity($months);
    }

    public function selectByMonth(int $monthID): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('month' => $monthID));
        $this->validator->processEntity($months);
    }

    public function selectByYear(int $year): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('year' => $year));
        $this->validator->processEntity($months);
    }

    public function insert(array $values): void
    {
        $monthEntity = new MonthEntity();

        $monthEntity->setName($values['name'])
        ->setDay($values['day'])
        ->setMonth($values['month'])
        ->setYear($values['year']);

        $this->entityManager->persist($monthEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(array $values): void
    {
        $monthEntity = $this->entityManager->find('app\entities\MonthEntity', $values['id']);
        $monthEntity->setName($values['name'])
        ->setDay($values['day'])
        ->setMonth($values['month'])
        ->setYear($values['year']);

        $this->entityManager->flush();
        
        Router::createResponse(true, null);
    }
    public function delete(int $id): void
    {
        $monthEntity = $this->entityManager->find('app\entities\MonthEntity', $id);
        $this->entityManager->remove($monthEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }
}