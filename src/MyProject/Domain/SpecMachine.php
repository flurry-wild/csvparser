<?php

namespace MyProject\Domain;

class SpecMachine extends BaseCar
{
    const PROPS = ['brand', 'passengerSeatsCount', 'photoFileName', 'carrying', 'extra'];
    public $type = 'specMachine';
}