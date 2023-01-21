<?php

namespace MyProject\Models;

use MyProject\Exceptions\InvalidArgumentException;

class BaseCarFactory
{
    public static function factory($row)
    {
        if ($row[0] === 'car') {
            return new Car();
        } elseif ($row[0] === 'truck') {
            return new Truck();
        } elseif ($row[0] === 'spec_machine') {
            return new SpecMachine();
        }

        throw new InvalidArgumentException('Неверный тип автомобиля');
    }
}