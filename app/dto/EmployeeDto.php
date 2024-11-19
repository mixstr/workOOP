<?php

namespace app\dto;

use DateTime;

class EmployeeDto
{
    public ?int $id;
    public string $fio;
    public ?DateTime $hireDate;
    public ?DateTime $terminationDate;

    public function __construct(?int $id = null, string $fio, ?DateTime $hireDate, ?DateTime $terminationDate) {
        $this->id = $id;
        $this->fio = $fio;
        $this->hireDate = $hireDate;
        $this->terminationDate = $terminationDate;
    }
}