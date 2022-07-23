<?php

namespace App\Providers;
use App\Http\Middleware\Core\ConfigMiddlewares;
use App\Http\Middleware\Core\QueueMiddleware;
use App\Http\Router;

class BootSystem
{
    public static function execute()
    {

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