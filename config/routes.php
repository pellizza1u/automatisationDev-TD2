<?php

use Slim\App;
use App\Controller\CompanyController;
use App\Controller\HomeController;

return function (App $app) {
    // On gère la route "par défaut" de l'application
    $app->get('/', HomeController::class . ':index');
    $app->get('/company/{id}', CompanyController::class . ':index');
};
