<?php

namespace App\Http\Controller\Internal;

use App\Sessions\Auth\AuthSession;
use App\Utils\View;
use Exception;

class MainController extends TemplateController
{
    public static function dashboard($request)
    {
        $content = View::render($request->getRouter()->getName(), []);
        return self::getTemplate($content, [
            "title"       => "Página Principal!",
            "description" => "Framework shield-force",
        ]);
    }

    public static function logout($request)
    {
        return AuthSession::logout() ?
            $request->getRouter()->redirect("/login") :
            throw new Exception("Error to logout!");
    }
}