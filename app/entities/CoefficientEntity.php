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
    private ?int $employeeId = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $monthId = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $coefficient = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmployee(): string
    {
        return $this->employeeId;
    }

    public function setEmployee(?int $newEmployeeId)
    {
        $this->employeeId = $newEmployeeId;
        return $this;
    }

    public function getMonth(): string
    {
        return $this->monthId;
    }

    public function setMonth(?int $newMonthId)
    {
        $this->monthId = $newMonthId;
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
        return new CoefficientDto($this->id, $this->employeeId, $this->monthId, $this->coefficient);
    }
}