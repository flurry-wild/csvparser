<?php

namespace MyProject\Handlers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\DataSource;
use MyProject\Services\Parser;
use MyProject\Domain\BaseCarFactory;

class GetCarsHandler
{
    private $parser;
    private $source;

    public function __construct(Parser $parser, DataSource $source)
    {
        $this->parser = $parser;
        $this->source = $source;
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
                    $car->fill($this->source, $row);

                    $cars[] = $car;
                } catch (InvalidArgumentException $e) {
                    continue;
                }
            }
        }

        return $cars;
    }
}