<?php

namespace App\Http\Controller\Internal;

use App\Utils\View;

class MainController extends TemplateController
{
    public static function getHome()
    {
        $content = View::render("internal/main/home", []);
        return self::getTemplate($content, [
            "title" => "Página Principal!",
            "description" => "Framework shield-force",
        ]);
    }
}