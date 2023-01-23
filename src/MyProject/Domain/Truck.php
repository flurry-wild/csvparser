<?php

namespace MyProject\Domain;

class Truck extends BaseCar
{
    const PROPS = ['brand', 'photoFileName', 'carrying'];
    const FLOAT_VALUES = ['carrying'];

    public $type = 'truck';
    public $body;

    private function fillBody($body)
    {
        $bodyParams = explode('x', $body);

        $this->body = new Body();
        $this->body->width = floatval($bodyParams[0]);
        $this->body->height = floatval($bodyParams[1]);
        $this->body->length = floatval($bodyParams[2]);
    }

    public function fill($source, $row)
    {
        parent::fill($source, $row);
        $this->fillBody($source->getValue('body', $row));
    }

    public function getBodyVolume()
    {
        return $this->body->width * $this->body->height * $this->body->length;
    }
}