<?php

use MyProject\View\View;
use MyProject\Controllers\MainController;
use MyProject\Handlers\GetCarsHandler;
use MyProject\Services\Parser;
use MyProject\Services\CsvParser;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\ForbiddenEception;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\DataSource;
use MyProject\Services\CsvDataSource;

try {
    require __DIR__ . '/src/container.php';

    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/src/routes.php';

    $dependencies = [
        DataSource::class => function ($container) {
            return new CsvDataSource();
        },
        Parser::class => function ($container) {
            return new CsvParser($container->make(CsvDataSource::class));
        },
        GetCarsHandler::class => function ($container) {
            return new GetCarsHandler($container->make(Parser::class));
        },
        MainController::class => function ($container) {
            return new MainController($container->make(GetCarsHandler::class));
        },
    ];

    Container::instance($dependencies);

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }

    }

    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = Container::instance()->make($controllerName);
    $controller->$actionName(...$matches);
} catch (NotFoundException $e) {
    $view = new View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (ForbiddenEception $e) {
    $view = new View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage(), 403]);
} catch (InvalidArgumentException $e) {
    $view = new View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
}