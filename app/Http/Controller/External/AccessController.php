<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class AccessController extends TemplateController
{
    public static function login()
    {
        $js = View::component("external/main/login/js/index", []);
        $head = View::component("external/main/login/css/index", []);
        $content = View::render("external/main/login", []);
        return self::getTemplate($content, [
            "title" => "Login!",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }

    public static function register()
    {
        $js = View::component("external/main/register/js/index", []);
        $head = View::component("external/main/register/css/index", []);
        $content = View::render("external/main/register", []);
        return self::getTemplate($content, [
            "title" => "Cadastro!",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }
}