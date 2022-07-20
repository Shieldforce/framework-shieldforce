<?php

namespace App\Http\Controller\Internal;

use App\config\DB\DB;
use App\Utils\View;

class DBController extends TemplateController
{
    public static function list($request)
    {

        $conn = DB::connection("mysql");
        dd([$conn->listDatabases()]);

        $content = View::render($request->getRouter()->getName(), []);
        return self::getTemplate($content, [
            "title"       => "Lista de Bancos!!",
            "description" => "Framework shield-force",
        ]);
    }
}