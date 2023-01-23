<?php

namespace MyProject\Domain;

use MyProject\Exceptions\InvalidArgumentException;

abstract class BaseCar
{
    const REQUIRED = ['photoFileName'];
    const FLOAT_VALUES = [];
    const INT_VALUES = [];
    const IS_IMAGE = ['photoFileName'];

    public $type;
    public $photoFileName;
    public $brand;
    public $passengerSeatsCount;
    public $carrying;

    private $source;

    public function fill($source, $row)
    {
        $this->source = $source;

        foreach (static::PROPS as $propName) {
            /** @var \MyProject\Services\DataSource $source */
            if ($this->validate($propName, $row)) {
                $this->setProp($propName, $row);
            } else {
                //Здесь можно сделать запись в лог
                throw new InvalidArgumentException('Валидация не пройдена, ' . $propName);
            }
        }
    }

    public function validate($propName, $row)
    {
        $value = $this->source->getValue($propName, $row);

        if (in_array($propName, static::REQUIRED)) {
            if ($value === null) {
                return false;
            }
        }

        if (in_array($propName, static::FLOAT_VALUES)) {
            if (!is_numeric($value)) {
                return false;
            }
        }

        if (in_array($propName, static::INT_VALUES)) {
            if (!preg_match("/^\d+$/", $value)) {
                return false;
            }
        }

        if (in_array($propName, static::IS_IMAGE)) {
            if (preg_match("/^(.*\.(?!(jpeg|png|jpg)$))?[^.]*$/", $value)) {
                return false;
            }
        }

        return true;
    }

    public function setProp($propName, $data)
    {
        $value = $this->source->getValue($propName, $data);

        if (in_array($propName, static::PROPS)) {
            if (in_array($propName, static::FLOAT_VALUES)) {
                $value = floatval($value);
            }
            if (in_array($propName, static::INT_VALUES)) {
                $value = intval($value);
            }
            $this->$propName = $value;
        }
    }
}