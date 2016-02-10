<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 10.02.16
 * Time: 11:14
 */
class Configs
{
    protected static $_instance;
    protected static $_configs = array();

    private function __construct()
    {

    }

    /**
     * Set default params to connect to database
     *
     *
     * @param $array
     */
    public static function setConfigs($array)
    {
        self::$_configs = $array;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public static function getBlock($block) {
        if (isset(self::$_configs[$block])) {
            return (object)self::$_configs[$block];
        } else {
            return new stdClass();
        }
    }
}