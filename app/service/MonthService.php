<?php

namespace app\service;

use Doctrine\ORM\EntityManager;
use app\entities\MonthEntity;
use app\core\Router;

require_once "bootstrap.php";

class MonthService
{
    public EntityManager $entityManager;

    public function __construct()
    {
        $this->entityManager = callEntityManager();
    }

    public function selectAll(array $request): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findAll();
        $this->toAnswer($months);
    }

    public function selectById(int $id): void
    {
        $months = $this->entityManager->find('app\entities\MonthEntity', $id);
        $this->toAnswer($months);
    }

    public function selectByName(string $name): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('name' => $name));
        $this->toAnswer($months);
    }

    public function selectByDay(int $day): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('day' => $day));
        $this->toAnswer($months);
    }

    public function selectByMonth(int $monthID): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('month' => $monthID));
        $this->toAnswer($months);
    }

    public function selectByYear(int $year): void
    {
        $months = $this->entityManager->getRepository('app\entities\MonthEntity')->findBy(array('year' => $year));
        $this->toAnswer($months);
    }

    public function insert(int $id, ?string $name, ?int $day, ?int $month, ?int $year): void
    {
        $monthEntity = new MonthEntity();

        $monthEntity->setId($id);

        foreach ($name as $value) {
            $monthEntity->setName($value);
        }

        foreach ($day as $value) {
            $monthEntity->setDay($value);
        }

        foreach ($month as $value) {
            $monthEntity->setMonth($value);
        }

        foreach ($year as $value) {
            $monthEntity->setYear($value);
        }

        $this->entityManager->persist($monthEntity);
        $this->entityManager->flush();

        Router::createResponse(true, null);
    }

    public function update(int $id, ?string $name, ?int $day, ?int $month, ?int $year): void
    {
        $monthEntity = $this->entityManager->find('app\entities\MonthEntity', $id);
        foreach ($name as $value) {
            $monthEntity->setName($value);
        }
        
        foreach ($day as $value) {
            $monthEntity->setDay($value);
        }
    
        foreach ($month as $value) {
            $monthEntity->setMonth($value);
        }

        foreach ($year as $value) {
            $monthEntity->setYear($value);
        }

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

    public function toAnswer(mixed $objects): void{
        $answer = [];
        if (is_object($objects) === true){
            $array = [
                "id" => $objects->getId(),
                "name" => $objects->getName(),
                "day" => $objects->getDay(),
                "month" => $objects->getMonth(),
                "year" => $objects->getYear()
            ];
            Router::createResponse(true, $array);
        }else {
            foreach ($objects as $object){
                $array = [
                    "id" => $object->getId(),
                    "name" => $object->getName(),
                    "day" => $object->getDay(),
                    "month" => $object->getMonth(),
                    "year" => $object->getYear()
                ];
                array_push($answer, $array);
                }
                Router::createResponse(true, $answer);
        }
    }
}