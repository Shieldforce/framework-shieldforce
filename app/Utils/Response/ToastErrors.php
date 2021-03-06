<?php

namespace App\Utils\Response;

use App\Http\Controller\ComponentsGlobals;
use App\Http\Request\Validations\Abstracts\ValidatorAbstract;

class ToastErrors
{
    public static function validation(ValidatorAbstract $validatorAbstract, $request)
    {
        if (isset($request)) {
            if($returnValidation = $validatorAbstract->execute($request->getPostParams())) {
                $iconToast       = 'fa fa-ban';
                $typeToast       = "danger";
                $titleToast      = $returnValidation["message"];
                $messageToast    = "<ul>";
                foreach ($returnValidation["errors"] as $error) {
                    foreach ($error as $error2) {
                        $messageToast   .= "<li>{$error2}</li>";
                        $messageToast   .= "<hr>";
                    }
                }
                $messageToast   .= "</ul>";
                $codeToast       = "Código erro: ".$returnValidation["code"];
                $visibilityToast = true;
                return ComponentsGlobals::toastForPhp(
                    $visibilityToast,
                    $titleToast,
                    $messageToast,
                    $codeToast,
                    $typeToast,
                    $iconToast
                );
            }
        }
        return null;
    }

    public static function unauthorized($request, $title='title empty', $message='message empty')
    {
        if (isset($request)) {
            $iconToast       = 'fa fa-ban';
            $typeToast       = "danger";
            $messageToast    = "<ul>";
            $messageToast   .= "<li>{$message}</li>";
            $messageToast   .= "</ul>";
            $codeToast       = "Unauthorized";
            $visibilityToast = true;
            return ComponentsGlobals::toastForPhp(
                $visibilityToast,
                $title,
                $messageToast,
                $codeToast,
                $typeToast,
                $iconToast
            );
        }
        return null;
    }

    public static function custom($request, $title='title empty', $message='message empty', $codeToast='Not Code')
    {
        if (isset($request)) {
            $iconToast       = 'fa fa-ban';
            $typeToast       = "danger";
            $messageToast    = "<ul>";
            $messageToast   .= "<li>{$message}</li>";
            $messageToast   .= "</ul>";
            $visibilityToast = true;
            return ComponentsGlobals::toastForPhp(
                $visibilityToast,
                $title,
                $messageToast,
                $codeToast,
                $typeToast,
                $iconToast
            );
        }
        return null;
    }
}