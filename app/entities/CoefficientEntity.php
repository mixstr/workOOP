<?php

namespace app\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: "coefficient")]
class CoefficientEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $employee_id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $month_id = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $coefficient = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $newId)
    {
        $this->id = $newId;
        return $this;
    }

    public function getEmployee(): string
    {
        return $this->employee_id;
    }

    public function setEmployee(?int $newEmployeeId)
    {
        $this->employee_id = $newEmployeeId;
        return $this;
    }

    public function getMonth(): string
    {
        return $this->month_id;
    }

    public function setMonth(?int $newMonthId)
    {
        $this->month_id = $newMonthId;
        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }
    
    public function setCoefficient(?float $newCoefficient)
    {
        $this->coefficient = $newCoefficient;
        return $this;
    }
}