<?php

namespace App\Http\Controller;

use App\Utils\View;

class ComponentsGlobals
{
    private static $prefixPath = "global.components.";

    public static function toastForAjax()
    {
        return View::component(self::$prefixPath."toastForAjax", []);
    }

    public static function toastForPhp($visibilityToast, $titleToast, $messageToast, $codeToast, $typeToast=null, $iconToast=null)
    {
        if($visibilityToast) {
            return View::component(self::$prefixPath."toastForPhp", [
                "titleToast" => $titleToast,
                "messageToast" => $messageToast,
                "typeToast" => $typeToast ?? '',
                "iconToast" => $iconToast ?? 'far fa-bell',
                "codeToast" => $codeToast ?? 'X',
            ]);
        }
         return null;
    }
}