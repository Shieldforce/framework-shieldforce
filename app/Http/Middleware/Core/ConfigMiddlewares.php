<?php

namespace App\Http\Middleware\Core;

class ConfigMiddlewares
{
    public static function middlewaresInject()
    {
        return [
            "maintenance"           => \App\Http\Middleware\CustomImplements\Maintenance::class,
            "clear_post"            => \App\Http\Middleware\CustomImplements\ClearPost::class,
            "validation_post"       => \App\Http\Middleware\CustomImplements\ValidationPost::class,
            "require_auth_logout"   => \App\Http\Middleware\CustomImplements\RequireAuthLogout::class,
            "auth"                  => \App\Http\Middleware\CustomImplements\Auth::class,
            "old_fields"            => \App\Http\Middleware\CustomImplements\OldFields::class
        ];
    }

    public static function middlewaresDefault()
    {
        return [
            "maintenance"
        ];
    }
}