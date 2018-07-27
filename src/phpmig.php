<?php

use \Phpmig\Adapter;
use \Phpmig\Pimple\Pimple;
use Pimple\Container;

use Phalcon\Di\FactoryDefault;

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

//print BASE_PATH . ":".__DIR__."\n";exit;
$di = new FactoryDefault();
include APP_PATH . '/config/router.php';
include APP_PATH . '/config/services.php';
$config = $di->getConfig();
include APP_PATH . '/config/loader.php';

$container = new Container();

// replace this with a better Phpmig\Adapter\AdapterInterface
$container['db'] = $di->get('db');
$container['phpmig.adapter'] = function () use ($container) {
    return new Phpmig\Adapter\PDO\Sql($container['db']->getInternalHandler(), 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'app/migrations';

// You can also provide an array of migration files
// $container['phpmig.migrations'] = array_merge(
//     glob('migrations_1/*.php'),
//     glob('migrations_2/*.php')
// );

return $container;
