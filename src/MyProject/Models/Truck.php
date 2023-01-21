<?php

namespace MyProject\Models;

use MyProject\Exceptions\InvalidArgumentException;

class Truck extends BaseCar
{
    public $type = 'truck';
    public $body;

    private function fillBody($body)
    {
        $bodyParams = explode('x', $body);
        if (count($bodyParams) !== 3) {
            throw new InvalidArgumentException(self::class . ':Не удалось определить формат кузова');
        }

        $this->body = new Body();
        $this->body->width = $bodyParams[0];
        $this->body->height = $bodyParams[1];
        $this->body->length = $bodyParams[2];
    }

    public function fill($row)
    {
        parent::fill($row);
        $this->fillBody($row[4]);
    }
}