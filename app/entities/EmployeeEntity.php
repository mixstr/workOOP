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
    private ?DateTime $hire_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTime $termination_date = null;

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
        return $this->hire_date;
    }

    public function setHireDate(?DateTime $hire_date)
    {
        $this->hire_date = $hire_date;
        return $this;
    }

    public function getTerminationDate(): ?DateTime
    {
        return $this->termination_date;
    }
    
    public function setTerminationDate(?DateTime $termination_date)
    {
        $this->termination_date = $termination_date;
        return $this;
    }

    public function getEntityDtoObject(): EmployeeDto
    {
        return new EmployeeDto($this->id, $this->fio, $this->hire_date, $this->termination_date);
    }
}