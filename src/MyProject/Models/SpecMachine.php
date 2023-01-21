<?php

namespace MyProject\Models;

class SpecMachine extends BaseCar
{
    public $type = 'specMachine';

    public function fill($row)
    {
        parent::fill($row);
        $this->extra = $row[6];
    }
}