<?php

use App\Http\Response;
use App\Http\Controller\Api;

/** @var \App\Http\Router $route */

$route->get("/api/main/list", [
    'middlewares' => [ ],
    function($request) {
        return new Response(200, Api\MainController::list($request));
    }
], "api.main.list");