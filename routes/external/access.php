<?php

use App\Http\Response;
use App\Http\Controller\External;

/** @var \App\Http\Router $route */

$route->get("/login", [
    'middlewares' => [ ],
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->post("/login", [
    'middlewares' => [ "clear_post" ],
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->get("/register", [
    'middlewares' => [ ],
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");

$route->post("/register", [
    'middlewares' => [ "clear_post" ],
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");



