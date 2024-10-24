<?php

namespace app\entities;

use app\dto\CoefficientDto;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: "coefficient")]
class CoefficientEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

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

    public function getEmployee(): string
    {
        return $this->employee_id;
    }

    public function setEmployee(?int $newEmployee_id)
    {
        $this->employee_id = $newEmployee_id;
        return $this;
    }

    public function getMonth(): string
    {
        return $this->month_id;
    }

    public function setMonth(?int $newMonth_id)
    {
        $this->month_id = $newMonth_id;
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

    public function getEntityDtoObject(): CoefficientDto
    {
        return new CoefficientDto($this->id, $this->employee_id, $this->month_id, $this->coefficient);
    }
}