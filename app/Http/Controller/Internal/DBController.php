<?php

namespace App\Http\Controller\Internal;

use App\config\DB\DB;
use App\Utils\Datatable\ServersideDatatable;
use App\Utils\View;

class DBController extends TemplateController
{

    private $conn;

    public function __construct()
    {
        $this->conn = DB::connection("mysql");
    }

    public static function list($request)
    {
        $js           = View::component($request->getRouter()->getName().".js.index", []);
        $head         = View::component($request->getRouter()->getName().".css.index", []);
        $content      = View::render($request->getRouter()->getName(), []);
        $list         = (new DBController)->conn->listDatabases();
        $listDB       = "<option value=''>Selecione o ID</option>";
        foreach ($list as $index => $value)
        {
            $listDB .= "<option value='{$index}'>{$index}</option>";
        }
        return self::getTemplate($content, [
            "title"             => "Lista de Bancos!!",
            "description"       => "Framework shield-force",
            "javascript-custom" => $js,
            "head-custom"       => $head,
            "listDB"            => $listDB
        ]);
    }

    public static function datatable($request)
    {
        $list  = (new DBController)->conn->listDatabases();
        return ServersideDatatable::datatableStart( $request->getPostParams(), $list, function ($posts, $columns) {
            $data = [];
            if( $posts ) {
                foreach ( $posts as $r ) {
                    foreach ( $columns as $key => $col ) {
                        if($col=="id") {
                            $nestedData["$col"] = $r["id"] ?? "-";
                        } elseif($col=="name") {
                            $nestedData["$col"] = $r["name"] ?? "-";
                        }  elseif($col=="action") {
                            $nestedData["$col"]   = "-";
                        } else {
                            $nestedData["$col"] = "-";
                        }
                    }
                    $data[] = $nestedData;
                }
            }
            return $data;
        });
    }

}