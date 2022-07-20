<?php

namespace App\config\DB\drivers;

use Config\crypt\Crypt;
use PDO;

class Mysql
{

    private static $pdo;

    private function connect($connection)
    {
        $passCrypt = $connection["password"];
        $password  = Crypt::decrypt($passCrypt);
        $driver    = $connection["driver"];
        $host      = $connection["host"];
        $port      = $connection["port"];
        $dbname    = $connection["dbname"];
        $username  = $connection["username"];
        $options   = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
            PDO::ATTR_PERSISTENT => TRUE
        );
        self::$pdo = new PDO(
            "{$driver}:host={$host}:{$port};dbname={$dbname}",
            "{$username}",
            "{$password}",
            $options
        );
        return $this;
    }

    public function __construct($connection)
    {
        self::connect($connection);
    }

    public static function raw($query)
    {
        $statement = self::$pdo->prepare($query);
        return $statement->execute();
    }

    public function createDB(string $name, string $charset="utf8", $collate="utf8_general_ci")
    {
        $statement = self::$pdo->prepare("CREATE DATABASE {$name} CHARACTER SET {$charset} COLLATE {$collate};");
        return $statement->execute();
    }

    public function createTable(string $name, array $columns = [])
    {
        $implode = implode(",", $columns);
        $statement = self::$pdo->prepare("CREATE TABLE {$name}($implode);");
        return $statement->execute();
    }

    public function listDatabases()
    {
        $query = self::$pdo->query("SHOW DATABASES;");
        $dbs = [];
        while( ( $db = $query->fetchColumn( 0 ) ) !== false )
        {
            $dbs[] = $db;
        }
        return $dbs;
    }



}