<?php 

/*
 * Returns an array with config info
 */
class Config{

    private static $config;

    public static function get($info){

        if(!self::$config){

            self::$config = require dirname(__DIR__) . '/config/Config.php';

        }

        return self::$config[$info];

    }

}


