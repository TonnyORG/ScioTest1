<?php

use Slim\Slim;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once '../vendor/autoload.php';

// Slim - Init
$app = new Slim();
$app->config(array(
	'debug' => true,
    'templates.path' => '../templates'
));

// Slim - Import Routes
require_once '../config/routes.php';

// PropelORM - Init
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('propel_scio1', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
    'dsn'      => 'mysql:host=localhost;dbname=propel_scio1',
    'user'     => 'root',
    'password' => '',
));
$serviceContainer->setConnectionManager('propel_scio1', $manager);

// Monolog/PropelORM - Debug
$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::DEBUG));
$serviceContainer->setLogger('defaultLogger', $defaultLogger);

// Slim - Run App
$app->run();