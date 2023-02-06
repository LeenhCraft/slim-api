<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

//rquiero el archivo de configuracion de la base de datos
require __DIR__ . '/../config/db.php';

$app = AppFactory::create();

require_once __DIR__ . '/../routes/web.php';

$app->run();
