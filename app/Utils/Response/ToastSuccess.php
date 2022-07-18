<?php

namespace App\Utils\Response;

use App\Http\Controller\ComponentsGlobals;

class ToastSuccess
{
    public static function render($title='title', $message='message', $status=false)
    {
        if(isset($request) && $status) {
            $iconToast       = 'fa fa-ban';
            $typeToast       = "success";
            $codeToast       = "0";
            $visibilityToast = true;
            return ComponentsGlobals::toastForPhp(
                $visibilityToast,
                $title,
                $message,
                $codeToast,
                $typeToast,
                $iconToast
            );
        }
    }
}