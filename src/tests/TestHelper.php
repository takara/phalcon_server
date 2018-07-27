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

// phalcon/incubator �̂��߂ɕK�v
include __DIR__ . "/../vendor/autoload.php";

// �A�v���P�[�V�����̃I�[�g���[�_���g�p���ăN���X���I�[�g���[�h����
// composer�̈ˑ��֌W���I�[�g���[�h����
$loader = new Loader();

$loader->registerDirs(
    [
        ROOT_PATH,
    ]
);

$loader->register();

$di = new FactoryDefault();

Di::reset();

// �K�v�ȃT�[�r�X��DI�ɓo�^����

Di::setDefault($di);
