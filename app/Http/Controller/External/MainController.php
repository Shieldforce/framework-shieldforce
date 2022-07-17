<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class MainController extends TemplateController
{
    public static function getIndex()
    {
        $content = View::render("external/main/index", []);
        return self::getTemplate($content, [
            "title" => "Página principal!",
            "description" => "Framework shield-force",
        ]);
    }
}