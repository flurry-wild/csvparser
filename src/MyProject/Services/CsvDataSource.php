<?php

namespace MyProject\Services;

class CsvDataSource implements DataSource
{
    protected $indexes = [
        'brand' => 1,
        'passengerSeatsCount' => 2,
        'photoFileName' => 3,
        'carrying' => 5,
        'extra' => 6
    ];

    public function getValue($propName, $row)
    {
        return $row[$this->indexes[$propName]];
    }
}