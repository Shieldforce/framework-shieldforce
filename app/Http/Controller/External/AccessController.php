<?php

namespace App\Http\Controller\External;

use App\Http\Request\Validations\LoginValidator;
use App\Sessions\Auth\AuthSession;
use App\Utils\Access\LoginProcess;
use App\Utils\Response\ToastErrors;
use App\Utils\View;
use Exception;

class AccessController extends TemplateController
{

    public static function login($request=null)
    {
        $js           = View::component($request->getRouter()->getName().".js.index", []);
        $head         = View::component($request->getRouter()->getName().".css.index", []);
        //--------------------------------------------------------------------------------------------------------------
        $content      = View::render($request->getRouter()->getName(), []);
        //--------------------------------------------------------------------------------------------------------------
        $toastErrors  = ToastErrors::validation(new LoginValidator(), $request);
        if (
            isset($request) &&
            !$toastErrors && $credentialsVerify = LoginProcess::credentialsVerify($request->getPostParams())
        ) {
            AuthSession::login($credentialsVerify) ?
                $request->getRouter()->redirect("/dashboard") :
                throw new Exception("Error is access dashboard!");
        }

        if(isset($_SESSION["unauthorized"])) {
            $toastErrors  = ToastErrors::unauthorized(
                $request,
                "Acessp negado!",
                "Você precisa está logado, para acessar está área!"
            );
            unset($_SESSION["unauthorized"]);
        }

        if($_SERVER["REQUEST_METHOD"]=="POST" && !$toastErrors && !$credentialsVerify) {
            $toastErrors  = ToastErrors::unauthorized(
                $request,
                "Erro ao logar",
                "Usuário ou senha incorreto!"
            );
        }

        return self::getTemplate($content, [
            "title"             => "Login ",
            "description"       => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom"       => $head,
            "toastForPhp"       => $toastErrors
        ]);
    }

    public static function register($request)
    {
        $js         = View::component($request->getRouter()->getName().".js.index", []);
        $head       = View::component($request->getRouter()->getName().".css.index", []);
        //--------------------------------------------------------------------------------------------------------------
        $content    = View::render($request->getRouter()->getName(), []);
        //--------------------------------------------------------------------------------------------------------------
        return self::getTemplate($content, [
            "title"             => "Cadastro ",
            "description"       => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom"       => $head,
        ]);
    }
}