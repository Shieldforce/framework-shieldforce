<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class AccessController extends TemplateController
{
    public static function getLogin()
    {
        $content = View::render("external/main/login", []);
        return self::getTemplate($content, [
            "title" => "Página de Login!",
            "description" => "Framework shield-force",
        ]);
    }
}