<?php

    return [
        "mysql"     => App\config\DB\drivers\Mysql::class,
        "mongodb"   => App\config\DB\drivers\MongoDB::class,
        "sqlite"    => App\config\DB\drivers\SQLite::class,
        "sqlserver" => App\config\DB\drivers\SqlServer::class,
    ];
