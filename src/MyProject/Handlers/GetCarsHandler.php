<?php

namespace MyProject\Handlers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Parser;
use MyProject\Domain\BaseCarFactory;

class GetCarsHandler
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function getCarList()
    {
        $result = $this->parser->getResult('src/assets/dat.csv');

        $cars = $this->fillCars($result);

        return $cars;
    }

    private function fillCars($data)
    {
        $cars = [];
        foreach ($data as $key => $row) {
            if ($key == 0 && $row[0] === 'car_type') {
                continue;
            } else {
                try {
                    $car = BaseCarFactory::factory($row);
                    $car->fill($this->parser->source, $row);

                    $cars[] = $car;
                } catch (InvalidArgumentException $e) {
                    continue;
                }
            }
        }

        return $cars;
    }
}