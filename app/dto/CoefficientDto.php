<?php

namespace app\dto;

class CoefficientDto
{
    public ?int $id;
    public int $employeeId;
    public int $monthId;
    public ?float $coefficient;

    public function __construct(?int $id = null, int $employeeId, int $monthId, ?float $coefficient = null) {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->monthId = $monthId;
        $this->coefficient = $coefficient;
    }
}