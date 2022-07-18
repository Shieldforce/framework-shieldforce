<?php

use App\Http\Response;
use App\Http\Controller\Internal;

/** @var \App\Http\Router $route */

$route->get("/dashboard", [
    'middlewares' => [ ],
    function($request) {
        return new Response(200, Internal\MainController::dashboard($request));
    }
], "internal.main.dashboard");


