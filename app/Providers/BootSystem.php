<?php

namespace App\Providers;

use App\Http\Middleware\ConfigMiddlewares;
use App\Http\Router;
use \App\Http\Middleware\QueueMiddleware;

class BootSystem
{
    public static function execute()
    {
        session_start();

        // $startConnection = \Config\db\StartConnection::getConnection();

        // Instance Route
        $route = new Router(env("APP_URL"));

        // Include routes all system
        $path = env("ROOT_PATH")."/routes";
        $arrayIncludes = enterTheFolderAndExecuteFunctionInclude([], $path);
        foreach ($arrayIncludes as $include) {
            include($include);
        }

        // Inject middlewares of routes
        QueueMiddleware::setMap(ConfigMiddlewares::middlewaresInject());

        // Inject middlewares defaults
        QueueMiddleware::setDefault(ConfigMiddlewares::middlewaresDefault());

        $route->run()
              ->sendResponse();

    }
}