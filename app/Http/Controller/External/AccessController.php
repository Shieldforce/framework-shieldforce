<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class AccessController extends TemplateController
{

    private static $prefixPath = "external/access";

    public static function login($request)
    {
        $js = View::component(self::$prefixPath."/login/js/index", []);
        $head = View::component(self::$prefixPath."/login/css/index", []);
        $content = View::render(self::$prefixPath."/login", []);
        return self::getTemplate($content, [
            "title" => "Login!",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }

    public static function register()
    {
        $js = View::component(self::$prefixPath."/register/js/index", []);
        $head = View::component(self::$prefixPath."/register/css/index", []);
        $content = View::render(self::$prefixPath."/register", []);
        return self::getTemplate($content, [
            "title" => "Cadastro!",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }
}