<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class MainController extends TemplateController
{
    private static $prefixPath = "external/main";

    public static function index()
    {
        $js = View::component(self::$prefixPath."/index/js/index", []);
        $head = View::component(self::$prefixPath."/index/css/index", []);
        $content = View::render(self::$prefixPath."/index", [
            "date('Y')" => date('Y')
        ]);
        return self::getTemplate($content, [
            "title" => "Principal",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }
}