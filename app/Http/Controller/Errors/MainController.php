<?php

namespace App\Http\Controller\Errors;

use App\Http\Controller\External\TemplateController;
use App\Utils\View;
use Throwable;

class MainController extends TemplateController
{

    public static function traceList($traces)
    {
        $trance_list = "";
        foreach ($traces as $tr) {
            $trance_list .= View::render("errors/template/components/trace_list", [
                "trace_file" => $tr["file"],
                "trace_line" => $tr["line"],
                "trace_function" => $tr["function"],
                "trace_class" => $tr["class"],
                "trace_type" => $tr["type"],
            ]);
        }
        return $trance_list;
    }

    public static function getErrors(Throwable $exception)
    {
        $code = $exception->getCode();
        $message = $exception->getMessage();
        $previous = $exception->getPrevious();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $js = View::render("errors/main/getErrors/js/index", []);
        $head = View::render("errors/main/getErrors/css/index", []);
        $content = View::render("errors/main/getErrors", [
            "code" => $code,
            "message" => $message,
            "previous" => $previous,
            "file" => $file,
            "line" => $line,
            "trace_list" => self::traceList($exception->getTrace())
        ]);
        return self::getTemplate($content, [
            "title" => "Erro : ",
            "description" => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom" => $head,
        ]);
    }
}