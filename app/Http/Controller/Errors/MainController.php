<?php

namespace App\Http\Controller\Errors;

use App\Enuns\TypesString;
use App\Http\Response;
use App\Utils\View;

class MainController extends TemplateController
{

    private static $prefixPath = "errors.main.";

    public static function getErrors($exception, TypesString $type = TypesString::RequestReturnTypeHtml)
    {

        $arrayError = [
            "code"       => $exception->getCode() ?? "",
            "message"    => $exception->getMessage() ?? "",
            "previous"   => $exception->getPrevious() ?? "",
            "file"       => $exception->getFile() ?? "",
            "line"       => $exception->getLine() ?? "",
            "trace_list" => self::traceList($exception->getTrace()) ?? "",
            "referer"    => $_SERVER["HTTP_REFERER"] ?? ""
        ];

        if ( $type->value == TypesString::RequestReturnTypeHtml->value ) {
            $content  = View::render(self::$prefixPath."getErrors", $arrayError);
            return self::getTemplate($content, [
                "title"             => "Erro : ",
                "description"       => "Framework shield-force",
            ]);
        }

        if ( $type->value == TypesString::RequestReturnTypeJson->value ) {
            Response::setHttpCode(500);
            return json_encode($arrayError);
        }
    }

    public static function traceList( array $traces )
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
}