<?php

namespace app\dto;

use DateTime;

class EmployeeDto
{
    public ?int $id;
    public string $fio;
    public ?DateTime $hire_date;
    public ?DateTime $termination_date;

    public function __construct(?int $id = null, string $fio, ?DateTime $hire_date, ?DateTime $termination_date) {
        $this->id = $id;
        $this->fio = $fio;
        $this->hire_date = $hire_date;
        $this->termination_date = $termination_date;
    }
}