<?php

$autoloadPath = __DIR__."/../vendor/autoload.php";

require($autoloadPath);

$dotenv = \Dotenv\Dotenv::createMutable(__DIR__."/../");

$dotenv->load();

$error = new \Config\error\Handle();

try {

    \App\Providers\BootSystem::execute();

    unset($_SESSION["error_session"]);

}  catch (\Throwable $exception) {

    $error->report($exception);
}

ddError($error);