<?php

use myfrm\App;


$container = new myfrm\ServiceContainer();
$container->setService(myfrm\Db::class, function () {
    $dbConfig = require CONFIG . '/db_config.php';
    return (myfrm\Db::getInstance())->getConnection($dbConfig);
});


App::setContainer($container);