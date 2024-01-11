<?php

use DI\ContainerBuilder;
use Slim\App;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();

$app = $container->get(App::class);
$app->addRoutingMiddleware();
$app->add(TwigMiddleware::createFromContainer($app));

(require __DIR__ . '/routes.php')($app);

return $app;
