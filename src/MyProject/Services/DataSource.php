<?php

namespace MyProject\Services;

interface DataSource
{
    function getValue($propName, $row);
}