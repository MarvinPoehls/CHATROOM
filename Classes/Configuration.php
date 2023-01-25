<?php

class Configuration
{
    protected static $data = null;

    public static function getConfigParameter($name)
    {
        if (file_exists("config.php")){
            if (self::$data == null) {
                self::loadData();
            }
            if (isset(self::$data[$name])) {
                return self::$data[$name];
            }
            return false;
        }
        throw new Exception("Config Data is missing.");
    }

    protected static function loadData(){
        include __DIR__."/../config.php";
        if (isset($data)) {
            self::$data = $data;
        }
    }
}