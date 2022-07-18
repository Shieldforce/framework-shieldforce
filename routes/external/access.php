<?php

use App\Http\Response;
use App\Http\Controller\External;

/** @var \App\Http\Router $route */

$route->get("/login", [
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->post("/login", [
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
], "external.access.login");

$route->get("/register", [
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");

$route->post("/register", [
    function($request) {
        return new Response(200, External\AccessController::register($request));
    }
], "external.access.register");



