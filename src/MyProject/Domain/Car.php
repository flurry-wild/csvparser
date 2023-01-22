<?php

namespace MyProject\Domain;

class Car extends BaseCar
{
    const PROPS = ['brand', 'passengerSeatsCount', 'photoFileName', 'carrying'];

    public $type = 'car';
}