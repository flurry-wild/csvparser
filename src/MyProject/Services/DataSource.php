<?php

namespace MyProject\Services;

interface DataSource
{
    function setProp($model, $propName, $data);
    function validate($propName, $row);
}