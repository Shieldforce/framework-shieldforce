<?php

namespace App\Http\Controller\Internal;

use App\Utils\View;

class MainController extends TemplateController
{
    private static $prefixPath = "internal.main.";

    public static function dashboard()
    {
        $content = View::render(self::$prefixPath."dashboard", []);
        return self::getTemplate($content, [
            "title" => "Página Principal!",
            "description" => "Framework shield-force",
        ]);
    }
}