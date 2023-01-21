<?php

namespace MyProject\Handlers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Parser;
use MyProject\Models\BaseCarFactory;

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

        $cars = [];
        foreach ($result as $key => $row) {
            if ($key == 0 && $row[0] === 'car_type') {
                continue;
            } else {
                try {
                    $car = BaseCarFactory::factory($row);
                    $car->fill($row);

                    $cars[] = $car;
                } catch (InvalidArgumentException $e) {
                    continue;
                }
            }
        }

        return $cars;
    }
}