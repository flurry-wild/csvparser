<?php

namespace MyProject\Controllers;

use MyProject\Handlers\GetCarsHandler;

class MainController extends AbstractController
{
    private $handler;

    public function __construct(GetCarsHandler $handler)
    {
        parent::__construct();

        $this->handler = $handler;
    }

    public function main()
    {
        $cars = $this->handler->getCarList();

        $this->view->renderHtml('main/main.php', ['cars' => $cars]);
    }
}