<?php

namespace MyProject\Models;

abstract class BaseCar
{
    public $type;
    public $photoFileName;
    public $brand;
    public $passengerSeatsCount;
    public $carrying;

    public function fill($row)
    {
        $this->brand = $row[1];
        $this->photoFileName = $row[3];
        $this->carrying = $row[5];
    }
}