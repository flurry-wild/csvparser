<?php

namespace MyProject\Domain;

class SpecMachine extends BaseCar
{
    const PROPS = ['brand', 'photoFileName', 'carrying', 'extra'];
    const FLOAT_VALUES = ['carrying'];
    public $type = 'specMachine';
}