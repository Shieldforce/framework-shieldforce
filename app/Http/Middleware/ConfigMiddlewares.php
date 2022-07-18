<?php

namespace App\Http\Middleware;

class ConfigMiddlewares
{
    public static function middlewaresInject()
    {
        return [
            "maintenance" => \App\Http\Middleware\Maintenance::class,
            "clear_post" => \App\Http\Middleware\ClearPost::class
        ];
    }

    public static function middlewaresDefault()
    {
        return [
            "maintenance"
        ];
    }
}