<?php

namespace App\Utils\Datatable;

use App\Http\Request\Request;
use Closure;

class ServersideDatatable
{

    private static Closure $returnColumnsFrontendCallable;
    private static Closure $dataSearchFilterCallable;

    public static function datatableStart(Request $request, array $list, callable $dataSearchFilterCallable, callable $returnColumnsFrontendCallable)
    {
        self::$returnColumnsFrontendCallable = $returnColumnsFrontendCallable;
        self::$dataSearchFilterCallable = $dataSearchFilterCallable;
        return self::datatableBody($request, $list);
    }

    private static function datatableBody(Request $request, array $list)
    {
        $requestPost    = $request->getPostParams();
        $columns        = array_column($requestPost["columns"], "name");
        $totalData      = count($list);
        $start          = $requestPost['start'];
        $limit          = $requestPost['length'];
        $order          = $columns[$requestPost['order']['0']['column']];
        $dir            = $requestPost['order']['0']['dir'];
        $list           = call_user_func(self::$dataSearchFilterCallable, $list, $start, $limit, $requestPost);
        $posts          = arrayOrderable($list, $order, $dir);
        $totalFiltered  = count($posts);
        $data           = call_user_func(self::$returnColumnsFrontendCallable, $posts, $columns);
        return            self::returnDatatableToFrontend($requestPost, $totalData, $totalFiltered, $data);
    }

    private static function returnDatatableToFrontend($requestPost, $totalData, $totalFiltered, $data)
    {
        return json_encode([
            "draw"                          => intval($requestPost['draw']),
            "recordsTotal"                  => intval($totalData),
            "recordsFiltered"               => intval($totalFiltered),
            "data"                          => $data
        ]);
    }
}