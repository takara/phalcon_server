<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// phalcon/incubator のために必要
include __DIR__ . "/../vendor/autoload.php";

// アプリケーションのオートローダを使用してクラスをオートロードする
// composerの依存関係をオートロードする
$loader = new Loader();

$loader->registerDirs(
    [
        ROOT_PATH,
    ]
);

$loader->register();

$di = new FactoryDefault();

Di::reset();

// 必要なサービスをDIに登録する

Di::setDefault($di);
