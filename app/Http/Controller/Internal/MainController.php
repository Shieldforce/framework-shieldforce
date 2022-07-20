<?php

namespace App\Http\Controller\Internal;

use App\Sessions\Auth\AuthSession;
use App\Utils\View;
use Exception;

class MainController extends TemplateController
{
    public static function dashboard($request)
    {
        $js           = View::component($request->getRouter()->getName().".js.index", []);
        $head         = View::component($request->getRouter()->getName().".css.index", []);
        $content = View::render($request->getRouter()->getName(), []);
        return self::getTemplate($content, [
            "title"             => "Página Principal!",
            "description"       => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom"       => $head,
        ]);
    }

    public static function logout($request)
    {
        return AuthSession::logout() ?
            $request->getRouter()->redirect("/login") :
            throw new Exception("Error to logout!");
    }
}