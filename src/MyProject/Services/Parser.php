<?php

namespace MyProject\Services;

interface Parser
{
    function getResult($fileName);
    function fillCars($data);
}