<?php

use App\Http\Response;
use App\Http\Controller\External;
use App\Utils\View;

/** @var \App\Http\Router $route */

// Init variables globals of views
View::init([
    "env('APP_NAME')" => env('APP_NAME'),
    "assets" => "template/assets",
    "author" => "Alexandre Ferreira do Nascimento",
]);

$route->get("/", [
    function() {
        return new Response(200, External\MainController::index());
    }
]);

$route->get("/login", [
    function($request) {
        return new Response(200, External\AccessController::login($request));
    }
]);

$route->get("/register", [
    function() {
        return new Response(200, External\AccessController::register());
    }
]);



