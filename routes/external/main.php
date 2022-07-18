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
    "date" => date("d/m/Y H:i:s")
]);

$route->get("/", [
    function($request) {
        return new Response(200, External\MainController::index($request));
    }
], "external.main.home");


