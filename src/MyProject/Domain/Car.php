<?php

namespace MyProject\Domain;

class Car extends BaseCar
{
    const PROPS = ['brand', 'passengerSeatsCount', 'photoFileName', 'carrying'];
    const INT_VALUES = ['passengerSeatsCount'];
    const FLOAT_VALUES = ['carrying'];

    public $type = 'car';
}