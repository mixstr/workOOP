<?php

namespace app\dto;

class CoefficientDto
{
    public ?int $id;
    public int $employee_id;
    public int $month_id;
    public ?float $coefficient;

    public function __construct(?int $id = null, int $employee_id, int $month_id, ?float $coefficient = null) {
        $this->id = $id;
        $this->employee_id = $employee_id;
        $this->month_id = $month_id;
        $this->coefficient = $coefficient;
    }
}