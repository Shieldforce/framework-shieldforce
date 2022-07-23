<?php

namespace App\Utils\Datatable;

use Closure;

class ServersideDatatable
{

    private static Closure $setColumns;

    public static function datatableStart(array $requestPost, object|array $list, callable $setColumns)
    {
        self::$setColumns = $setColumns;
        return self::datatableBody($requestPost, $list);
    }

    private static function datatableBody(array $requestPost, object|array $list)
    {
        $columns        = array_column($requestPost["columns"], "name");
        $totalData      = count($list);
        $start          = $requestPost['start'];
        $limit          = $requestPost['length'] + $start;
        $order          = $columns[$requestPost['order']['0']['column']];
        $dir            = $requestPost['order']['0']['dir'];


        $totalFiltered  = 0;
        $posts          = [];


        $data           = call_user_func(self::$setColumns, $posts, $columns);
        return self::returnDatatable($requestPost, $totalData, $totalFiltered, $data);
    }

    private static function returnDatatable($requestPost, $totalData, $totalFiltered, $data)
    {
        return json_encode([
            "draw"                          => intval($requestPost['draw']),
            "recordsTotal"                  => intval($totalData),
            "recordsFiltered"               => intval($totalFiltered),
            "data"                          => $data
        ]);
    }
}