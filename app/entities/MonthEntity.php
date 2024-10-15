<?php

namespace app\Entities;

use app\dto\MonthDto;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: "month")]
class MonthEntity 
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private ?string $name = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $day = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $month = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $year = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day)
    {
        $this->day = $day;
        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(?int $month)
    {
        $this->month = $month;
        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year)
    {
        $this->year = $year;
        return $this;
    }

    public function getEntityDtoObject(): MonthDto
    {
        return new MonthDto($this->id, $this->name, $this->day, $this->month, $this->year);
    }
}