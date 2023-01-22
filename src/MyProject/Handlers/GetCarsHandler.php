<?php

namespace MyProject\Handlers;

use MyProject\Services\Parser;

class GetCarsHandler
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function getCarList()
    {
        $result = $this->parser->getResult('src/assets/data.csv');

        $cars = $this->parser->fillCars($result);

        return $cars;
    }
}