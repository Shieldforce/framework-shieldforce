<?php

namespace Config\db;

class StartConnection
{
    private static $connection;

    private static function setConnection()
    {
        $driver = env("DB_DRIVER");
        $stringClass = "\\Config\\db\\types\\{$driver}\\Connection";
        self::$connection = $stringClass::execute();
    }

    public static function getConnection()
    {
        self::setConnection();
        return self::$connection;
    }
}