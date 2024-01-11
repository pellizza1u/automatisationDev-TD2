<?php

use App\Console\CreateDatabaseCommand;
use App\Console\PopulateDatabaseCommand;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = (new ContainerBuilder())
    ->addDefinitions(__DIR__ . '/../config/container.php')
    ->build();

try {
    /** @var Application $application */
    $application = $container->get(Application::class);

    // Register your console commands here
    $application->add($container->get(CreateDatabaseCommand::class));
    $application->add($container->get(PopulateDatabaseCommand::class));

    exit($application->run());
} catch (Throwable $exception) {
    echo $exception->getMessage();
    exit(1);
}

