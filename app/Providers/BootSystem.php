<?php

namespace App\Providers;

use App\Http\Router;

class BootSystem
{
    public static function execute()
    {
        session_start();

        // $startConnection = \Config\db\StartConnection::getConnection();
        // $request = new \App\Http\Request();
        // $response = new \App\Http\Response(500, "Olá mundo");

        // Instance Route
        $route = new Router(env("APP_URL"));

        // Include routes all system
        $path = env("ROOT_PATH")."/routes";
        $arrayIncludes = enterTheFolderAndExecuteFunctionInclude([], $path);
        foreach ($arrayIncludes as $include) {
            include($include);
        }

        $route->run()
              ->sendResponse();

    }
}