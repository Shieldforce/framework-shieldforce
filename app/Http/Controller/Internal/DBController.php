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

    // Start Data table ------------------------------------------------------------------------------------------------
    public static function datatable($request)
    {
        $list  = (new DBController)->conn->listDatabases();
        return ServersideDatatable::datatableStart(
            $request,
            $list,
            function ($list, $start, $limit, $requestPost) {
                return self::dataSearchFilter($list, $start, $limit, $requestPost);
            },
            function ($posts, $columns) {
                return self::returnColumnsFrontend($posts, $columns);
            },
        );
    }
    // -----------------------------------------------------------------------------------------------------------------
    private static function setColumns($index, $value)
    {
        return [
            "id"      => $index,
            "name"    => $value
        ];
    }
    // -----------------------------------------------------------------------------------------------------------------
    private static function returnColumnsFrontend($posts, $columns)
    {
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
    }
    // -----------------------------------------------------------------------------------------------------------------
    private static function dataSearchFilter($list, $start, $limit, $requestPost)
    {
        $posts = [];
        foreach ($list as $index => $value) {
            if ($index >= $start && $index <= $limit ) {
                $posts[$index] = self::setColumns($index, $value);
            }
        }

        $searchCustom = $requestPost["searchCustom"];
        $searchCustom = self::filterIsNotNull($searchCustom);

        return $posts;
    }
    // -----------------------------------------------------------------------------------------------------------------
    private static function filterIsNotNull($searchCustom)
    {
        foreach ($searchCustom as $index => $sc) {
            if(!$sc["value"]) {
                unset($searchCustom[$index]);
            }
        }
        return $searchCustom;
    }
    // End Data table --------------------------------------------------------------------------------------------------

}