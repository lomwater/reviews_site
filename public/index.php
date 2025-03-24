<?php

session_start();

use myfrm\App;
use myfrm\ServiceContainer;
use myfrm\Router;

require '../vendor/autoload.php';
require dirname(__DIR__) . '/config/path_config.php';
require CORE . '/functions.php';
require 'bootstrap.php';

$serviceContainer = new ServiceContainer();

$db = App::get(myfrm\Db::class);

$router = new Router();
require CONFIG . '/routes.php';

$router->match();