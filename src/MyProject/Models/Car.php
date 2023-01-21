<?php

namespace MyProject\Models;

class Car extends BaseCar
{
    public $type = 'car';

    public function fill($row)
    {
        parent::fill($row);
        $this->passengerSeatsCount = $row[2];
    }
}