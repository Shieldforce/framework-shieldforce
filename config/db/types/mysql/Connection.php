<?php

namespace Config\db\types\mysql;

use Config\crypt\Crypt;
use Config\db\interfaces\ConnectionInterface;
use PDO;

class Connection implements ConnectionInterface
{
    private static $pdo;

    private function __construct(){}

    /**
     * @return PDO
     * Singleton
     */
    public static function execute()
    {
        $passwordCrypt = env("DB_PASSWORD");
        $password = Crypt::decrypt($passwordCrypt);
        $host = env("DB_HOST");
        $port = env("DB_PORT");
        $username = env("DB_USERNAME");
        $password = str_replace(["\n"],[""],$password);
        $driver = env("DB_DRIVER");
        $dbname = env("DB_NAME");

        if(!isset(self::$pdo)) {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
            self::$pdo = new PDO(
                "{$driver}:host={$host}:{$port};dbname={$dbname}",
                "{$username}",
                "{$password}",
                $options
            );
        }
        return self::$pdo;
    }

}