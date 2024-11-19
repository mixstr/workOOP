<?php

namespace app\entities;

use app\dto\EmployeeDto;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: "employees")]
class EmployeeEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private ?string $fio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTime $hireDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTime $terminationDate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFio(): string
    {
        return $this->fio;
    }

    public function setFio(?string $fio)
    {
        $this->fio = $fio;
        return $this;
    }

    public function getHireDate(): DateTime 
    {
        return $this->hireDate;
    }

    public function setHireDate(?DateTime $hireDate)
    {
        $this->hireDate = $hireDate;
        return $this;
    }

    public function getTerminationDate(): ?DateTime
    {
        return $this->terminationDate;
    }
    
    public function setTerminationDate(?DateTime $terminationDate)
    {
        $this->terminationDate = $terminationDate;
        return $this;
    }

    public function getEntityDtoObject(): EmployeeDto
    {
        return new EmployeeDto($this->id, $this->fio, $this->hireDate, $this->terminationDate);
    }
}