<?php

use App\Http\Response;
use App\Http\Controller\Api;

/** @var \App\Http\Router $route */

$route->get("/api/teste", [
    function() {
        return new Response(200, Api\MainController::index());
    }
]);