<?php

namespace MyProject\Domain;

abstract class BaseCar
{
    public $type;
    public $photoFileName;
    public $brand;
    public $passengerSeatsCount;
    public $carrying;

    public function fill($source, $row)
    {
        foreach (static::PROPS as $propName) {
            /** @var \MyProject\Domain\DataSource $source */
            $source->setProp($this, $propName, $row);
        }
    }
}