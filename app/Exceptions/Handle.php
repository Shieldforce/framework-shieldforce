<?php

namespace App\Exceptions;

use App\Enuns\TypesString;
use App\Exceptions\HtmlResponseException;
use App\Exceptions\JsonResponseException;
use Exception;
use PDOException;
use Throwable;

class Handle
{
    public function report($exception)
    {

        $accept = $_SERVER["HTTP_ACCEPT"];
        if (mb_strpos($accept, 'application/json') !== false || mb_strpos($accept, 'text/javascript') !== false) {
            $typesString = TypesString::RequestReturnTypeJson;
        } else {
            $typesString = TypesString::RequestReturnTypeHtml;
        }

        if ($exception instanceof HtmlResponseException) {
            return \App\Http\Controller\Errors\MainController::getErrors($exception, $typesString);
        }

        if ($exception instanceof JsonResponseException) {
            return \App\Http\Controller\Errors\MainController::getErrors($exception, $typesString);
        }

        if ($exception instanceof PDOException) {
            return \App\Http\Controller\Errors\MainController::getErrors($exception, $typesString);
        }

        if ($exception instanceof Throwable) {
            return \App\Http\Controller\Errors\MainController::getErrors($exception, $typesString);
        }
        if ($exception instanceof Exception) {
            return \App\Http\Controller\Errors\MainController::getErrors($exception, $typesString);
        }

        return \App\Http\Controller\Errors\MainController::getErrors($exception);
    }
}