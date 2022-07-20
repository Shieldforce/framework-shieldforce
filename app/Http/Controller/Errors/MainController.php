<?php

namespace App\Http\Controller\Errors;

use App\Utils\View;
use Throwable;

class MainController extends TemplateController
{

    private static $prefixPath = "errors.main.";

    public static function traceList($traces)
    {
        $trance_list = "";
        foreach ($traces as $tr) {
            $trance_list .= View::component("errors.template.components.trace_list", [
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
        $referer  = $_SERVER["HTTP_REFERER"];
        $code     = $exception->getCode();
        $message  = $exception->getMessage();
        $previous = $exception->getPrevious();
        $file     = $exception->getFile();
        $line     = $exception->getLine();
        $content  = View::render(self::$prefixPath."getErrors", [
            "code"       => $code ?? "",
            "message"    => $message ?? "",
            "previous"   => $previous ?? "",
            "file"       => $file ?? "",
            "line"       => $line ?? "",
            "trace_list" => self::traceList($exception->getTrace()),
            "referer"    => $referer
        ]);
        return self::getTemplate($content, [
            "title"             => "Erro : ",
            "description"       => "Framework shield-force",
        ]);
    }
}