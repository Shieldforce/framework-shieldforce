<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class MainController extends TemplateController
{
    public static function getIndex()
    {
        $js = View::component("external/main/index/js/index", []);
        $head = View::component("external/main/index/css/index", []);
        $content = View::render("external/main/index", [
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