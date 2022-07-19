<?php

function server($key=null)
{
    return $key ? $_SERVER[$key] : $_SERVER;
}

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

function old($field)
{
    return $_SESSION[$field] ?? null;
}
