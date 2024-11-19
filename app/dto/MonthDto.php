<?php

namespace app\dto;

class MonthDto
{
    public ?int $id;
    public ?string $name;
    public ?int $day;
    public ?int $month;
    public ?int $year;

    public function __construct(?int $id = null, ?string $name, ?int $day, ?int $month, ?int $year) {
        $this->id = $id;
        $this->name = $name;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }
}