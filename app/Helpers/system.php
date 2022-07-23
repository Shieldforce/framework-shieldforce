<?php

function env($index, $value=null)
{
    if($value) {
        return $_ENV[$index] = $value;
    }
    return str_replace(["\n"],[""], $_ENV[$index]);
}

function enterTheFolderAndExecuteFunctionInclude($arrayIncludes, $path)
{
    $scanDir = scandir($path);
    foreach ($scanDir as $dirOrFile) {
        if ($dirOrFile!='.' && $dirOrFile!='..') {
            $pathOrFile = $path."/".$dirOrFile;
            if(is_file($pathOrFile)) {
                $arrayIncludes[] = $pathOrFile;
            } else {
                if (is_dir($pathOrFile)) {
                    $arrayIncludes = enterTheFolderAndExecuteFunctionInclude($arrayIncludes, $pathOrFile);
                }
            }
        }
    }
    return $arrayIncludes;
}

function redirect($url, $status=null)
{
    header('Location: ' . $url, true, $status ?? 301);
    die;
}

function arrayOrderable($list, $order, $dir)
{
    $orderable = $dir == "asc" ? SORT_ASC : SORT_DESC;
    array_multisort(array_map(function ($element) use($order){
        return $element[$order];
    }, $list), $orderable, $list);
    return $list;
}

function urlServerFull($endpoint)
{
    $uri = $_SERVER["SERVER_NAME"];
    $urlLast = $uri."/".$endpoint;
    return $_SERVER["REQUEST_SCHEME"]."://".str_replace("//", "/", $urlLast);
}
