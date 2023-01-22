<?php

namespace MyProject\Services;

class CsvDataSource implements DataSource
{
    protected $indexes = [
        'brand' => 1,
        'passengerSeatsCount' => 2,
        'photoFileName' => 3,
        'carrying' => 5,
        'extra' => 6
    ];
    protected $requiredValues = [];
    protected $floatValues = [];
    protected $intValues = [];

    public function setProp($model, $propName, $data)
    {
        if (in_array($propName, $model::PROPS)) {
            $key = $this->indexes[$propName];

            if (in_array($propName, $this->floatValues)) {
                $data[$key] = floatval($data[$key]);
            }
            if (in_array($propName, $this->intValues)) {
                $data[$key] = intval($data[$key]);
            }
            $model->$propName = $data[$key];
        }
    }

    public function initValidation($requiredValues, $floatValues, $intValues)
    {
        $this->requiredValues = $requiredValues;
        $this->floatValues = $floatValues;
        $this->intValues = $intValues;
    }

    public function validate($propName, $row)
    {
        if (in_array($propName, $this->requiredValues)) {
            if (empty($row[$this->indexes[$propName]])) {
                return false;
            }
        }

        if (in_array($propName, $this->floatValues)) {
            if (!is_float($row[$this->indexes[$propName]])) {
                return false;
            }
        }

        if (in_array($propName, $this->intValues)) {
            if (!is_integer($row[$this->indexes[$propName]])) {
                return false;
            }
        }

        return true;
    }
}