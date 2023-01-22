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

    function setProp($model, $propName, $data)
    {
        if (!in_array($propName, $model::PROPS)) {
            $model->$propName = null;
        }

        $key = $this->indexes[$propName];
        $model->$propName = $data[$key];
    }
}