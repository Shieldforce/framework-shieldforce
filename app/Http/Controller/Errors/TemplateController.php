<?php

namespace App\Http\Controller\Errors;

use App\Utils\View;

class TemplateController
{
    private static $prefixPath = "errors.template.";

    private static function getHead()
    {
        return View::component(self::$prefixPath."head", []);
    }


    public static function getTemplate($content, array $args = [])
    {
        $arrayContent = [
            "head"          => self::getHead(),
            "content"       => $content,
            "javascript"    => self::getJavascript(),
            "toastForPhp"   => null,
            "toastForAjax"  => null,
        ];
        $arrayAll = array_merge($arrayContent, $args);
        return View::component(self::$prefixPath."index", $arrayAll);
    }

    private static function getJavascript()
    {
        return View::component(self::$prefixPath."javascript", []);
    }
}