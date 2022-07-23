<?php

$autoloadPath = __DIR__."/../vendor/autoload.php";

require($autoloadPath);

$dotenv = \Dotenv\Dotenv::createMutable(__DIR__."/../");

$dotenv->load();

$error = new \App\Exceptions\Handle();

try {

    \App\Providers\BootSystem::execute();

} catch (\App\Exceptions\HtmlResponseException $exception) {

    echo $error->report($exception);

} catch (\App\Exceptions\JsonResponseException $exception) {

    echo $error->report($exception);

} catch (\Throwable $exception) {

    echo $error->report($exception);

} /*finally {

    unset($_SESSION["redirectParams"]);

}*/