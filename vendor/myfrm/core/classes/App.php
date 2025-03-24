<?php

namespace myfrm;

class App
{
    public static object $container;

    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    public static function getContainer(): object
    {
        return static::$container;
    }

    public static function get($service)
    {
        return static::getContainer()->getService($service);
    }
}
