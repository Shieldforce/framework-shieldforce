<?php

use App\Http\Response;
use App\Http\Controller\Internal;

/** @var \App\Http\Router $route */

$route->get("/db/list", [
    'middlewares' => [ "auth" ],
    function($request) {
        return new Response(200, Internal\DBController::list($request));
    }
], "internal.db.list");


