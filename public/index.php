<?php

use Slim\Slim;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

require_once '../vendor/autoload.php';

// Slim - Init
$app = new Slim();
$app->config(array(
    'templates.path' => '../templates'
));

// Slim - Import Routes
require_once '../config/routes.php';

// PropelORM - Init
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('scio1', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
    'dsn'      => 'mysql:host=localhost;dbname=propel_scio1',
    'user'     => 'root',
    'password' => '',
));
$serviceContainer->setConnectionManager('scio1', $manager);

// Slim - Run App
$app->run();