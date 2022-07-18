<?php

namespace App\Http\Controller\External;

use App\Utils\View;

class MainController extends TemplateController
{

    public static function index($request)
    {
        $js = View::component($request->getRouter()->getName().".js.index", []);
        $head = View::component($request->getRouter()->getName().".css.index", []);
        $content = View::render($request->getRouter()->getName(), [
            "date('Y')" => date('Y')
        ]);
        return self::getTemplate($content, [
            "title" => "Principal",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }

    public static function terms($request)
    {
        $js = View::component($request->getRouter()->getName().".js.index", []);
        $head = View::component($request->getRouter()->getName().".css.index", []);
        $content = View::render($request->getRouter()->getName(), [
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