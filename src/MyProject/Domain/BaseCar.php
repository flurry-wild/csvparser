<?php

namespace MyProject\Domain;

abstract class BaseCar
{
    const REQUIRED = ['photoFileName'];
    const FLOAT_VALUES = [];
    const INT_VALUES = [];

    public $type;
    public $photoFileName;
    public $brand;
    public $passengerSeatsCount;
    public $carrying;

    public function fill($source, $row)
    {
        $source->initValidation(static::REQUIRED, static::FLOAT_VALUES, static::INT_VALUES);
        foreach (static::PROPS as $propName) {
            if ($source->validate($propName, $row)) {
                /** @var \MyProject\Services\DataSource $source */
                $source->setProp($this, $propName, $row);
            }
        }
    }
}