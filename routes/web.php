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
        return new Response(200, External\MainController::getIndex());
    }
]);

$route->get("/sobre", [
    function() {
        return new Response(200, External\MainController::getIndex());
    }
]);

$route->get("/pagina/{id}/{action}", [
    function($id, $action) {
        return new Response(200, "Pagina {$id}.{$action}");
    }
]);



