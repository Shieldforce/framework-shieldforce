<?php

namespace App\config\DB;

class DB
{
    public static function connection($DB_CONNECTION)
    {
        $arrayConnections = require(env("ROOT_PATH")."/app/config/DB/connections.php");
        $connection = [];
        foreach ($arrayConnections[$DB_CONNECTION] as $index => $conn) {

            $db_connection = preg_match('/DB_DRIVER.*/', $index);
            if($db_connection) { $connection['driver'] = $conn; }

            $db_host = preg_match('/DB_HOST.*/', $index);
            if($db_host) { $connection['host'] = $conn; }

            $db_username = preg_match('/DB_USERNAME.*/', $index);
            if($db_username) { $connection['username'] = $conn; }

            $db_password = preg_match('/DB_PASSWORD.*/', $index);
            if($db_password) { $connection['password'] = $conn; }

            $db_name = preg_match('/DB_NAME.*/', $index);
            if($db_name) { $connection['dbname'] = $conn; }

            $db_port = preg_match('/DB_PORT.*/', $index);
            if($db_port) { $connection['port'] = $conn; }

        }
        $drivers = require(env("ROOT_PATH")."/app/config/DB/drivers.php");
        $class = new $drivers[$connection['driver']]($connection);
        return $class;
    }
}