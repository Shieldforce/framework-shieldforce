<?php

use App\Http\Response;
use App\Http\Controller\External;

/** @var \App\Http\Router $route */

$route->get("/login", [
    'middlewares' => [ "require_auth_logout" ],
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->post("/login", [
    'middlewares' => [ "require_auth_logout", "clear_post", "validation_post" ],
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->get("/register", [
    'middlewares' => [ "require_auth_logout" ],
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");

$route->post("/register", [
    'middlewares' => [ "require_auth_logout", "clear_post", "validation_post" ],
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");



