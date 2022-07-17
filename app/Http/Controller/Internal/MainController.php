<?php

namespace App\Http\Controller\Internal;

use App\Utils\View;

class MainController extends TemplateController
{
    private static $prefixPath = "internal/main";

    public static function home()
    {
        $content = View::render(self::$prefixPath."/home", []);
        return self::getTemplate($content, [
            "title" => "Página Principal!",
            "description" => "Framework shield-force",
        ]);
    }
}