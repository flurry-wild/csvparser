<?php

namespace MyProject\Controllers;

use MyProject\Handlers\GetCarsHandler;
use MyProject\Services\Parser;

class MainController extends AbstractController
{
    private $parser;

    public function __construct(Parser $parser)
    {
        parent::__construct();

        $this->parser = $parser;
    }

    public function main()
    {
        $cars = (new GetCarsHandler($this->parser))->getCarList();

        $this->view->renderHtml('main/main.php', ['cars' => $cars]);
    }
}