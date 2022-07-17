<?php

function ddError(\Config\error\Handle $handle)
{
    if(isset($_SESSION["error_session"])) {
        verifyTypeValueError($handle);
        die;
    }
}

function dd($value, $type='print_r')
{
    verifyTypeValue($value, $type);
    die;
}

function isArrayFormat($value, $type)
{
    //$valueReplace = replaceValuesArray($value);
    echo "<pre style='background: black;height: 100%;padding: 0;margin: 0;overflow-y: scroll;'>";
    echo "<div style='color: white;padding: 20px;'>";
    if($type=="var_dump") {
        var_dump($value);
    }elseif($type=="print_r") {
        print_r($value);
    } else {
        print_r($value);
    }
    echo "</div>";
    echo "</pre>";
    return true;
}

function isObjectFormat($object, $type)
{
    //$valueReplace = replaceValuesArray((array) $object);
    echo "<pre style='background: black;height: 100%;padding: 0;margin: 0;overflow-y: scroll;'>";
    echo "<div style='color: white;padding: 20px;'>";
    if($type=="var_dump") {
        var_dump($object);
    }elseif($type=="print_r") {
        print_r($object);
    } else {
        print_r($object);
    }
    echo "</div>";
    echo "</pre>";
    return true;
}

function isObjectFormatError(\Config\error\Handle $handle)
{
    $valueReplace = replaceValuesArrayError($handle);
    echo "<pre style='background: black;height: 100%;padding: 0;margin: 0;overflow-y: scroll;'>";
    echo "<div style='color: white;padding: 20px;'>";
    echo $valueReplace;
    echo "</div>";
    echo "</pre>";
    return true;
}

function isStringFormat($value)
{
    echo "<pre style='background: black;height: 100%;padding: 0;margin: 0;overflow-y: scroll;'>";
    echo "<div style='color: white;padding: 20px;'>";
    print_r($value);
    echo "</div>";
    echo "</pre>";
    return true;
}

function verifyTypeValue($value, $type=null)
{
    if(is_array($value)) {
       isArrayFormat($value, $type);
    }
    if(is_object($value)) {
        isObjectFormat($value, $type);
    }
    if(is_string($value)) {
        isStringFormat($value);
    }
}

function verifyTypeValueError(\Config\error\Handle $handle)
{
    if(is_object($handle)) {
        isObjectFormatError($handle);
    }
}

function replaceValuesArray($value)
{
    $string = "<ul>";
    foreach ($value as $index => $op) {
        $valueA = str_replace(["\n"],[""], $op);
        $string .= "<li> <span style='color: orangered'>{$index}</span> <span style='color: cornflowerblue'>=></span> <span style='color: green'>{$valueA}</span>";
        if(is_array($op)) {
            $string .= "<ul>";
            foreach ($op as $index2 => $op2) {
                $valueB = str_replace(["\n"],[""], $op2);
                $string .= "<li> <span style='color: orangered'>{$index2}</span> <span style='color: cornflowerblue'>=></span> <span style='color: green'>{$valueB}</span>";
                if(is_array($op2)) {
                    $string .= "<ul>";
                    foreach ($op2 as $index3 => $op3) {
                        $valueC = str_replace(["\n"],[""], $op3);
                        $string .= "<li> <span style='color: orangered'>{$index3}</span> <span style='color: cornflowerblue'>=></span> <span style='color: green'>{$valueC}</span>";
                        if(is_array($op3)) {
                            $string .= "<ul>";
                            foreach ($op3 as $index4 => $op4) {
                                $valueD = str_replace(["\n"],[""], $op4);
                                $string .= "<li> <span style='color: orangered'>{$index4}</span> <span style='color: cornflowerblue'>=></span> <span style='color: green'>{$valueD}</span> </li>";
                            }
                            $string .= "</ul>";
                        }
                        $string .= "</li>";
                    }
                    $string .= "</ul>";
                }
                $string .= "</li>";
            }
            $string .= "</ul>";
        }
        $string .= "</li>";
    }
    $string .= "</ul>";
    return $string;
}

function replaceValuesArrayError(\Config\error\Handle $handle)
{
    $string = "<hr>";
    $string .= "<div style='text-align: center;background: rgba(255,255,255,0.1);padding: 5px;'><h2 style='color: darkred;'>{$handle->getMessage()}</h2></div>";
    $string .= "<div style='width: 100%;height: auto;'>";
    $string .= "<div style='position:relative;float:left;width: 50%;height: 80% ;border: 1px dashed rgba(255,255,255,0.2);margin-top: 2px;overflow-y: scroll;overflow-x: hidden;padding: 10px;text-align: justify;'>";
    $string .= "<div style='text-align: center;background: rgba(255,255,255,0.1);'><h2 style='color: cornflowerblue;padding: 5px;top:0;margin-top: 0;'>PILHA DE ERROS!</h2></div>";
    foreach ($handle->getTrace() as $line)
    {
        $string .= "<div style='width: auto;background:rgba(255,255,255,0.1); padding: 10px; list-style-type: none;border-bottom: 1px dashed rgba(255,255,255,0.1);margin-bottom: 5px;'>";
        $string .= "<div style='text-align: justify;'>File : <span style='color: yellow;text-align: justify'>{$line['file']}</span></div>";
        $string .= "<div style='text-align: justify;'>Line : <span style='color: yellow;'>{$line['line']}</span></div>";
        $string .= "<div style='text-align: justify;'>Func : <span style='color: yellow;'>{$line['function']}</span></div>";
        $string .= "<div style='text-align: justify;'>Clas : <span style='color: yellow;'>{$line['class']}</span></div>";
        $string .= "<div style='text-align: justify;'>Type : <span style='color: yellow;'>{$line['type']}</span></div>";
        $string .= "</div>";
    }
    $string .= "</div>";
    $string .= "<div style='background: rgba(255,255,255,0.2);position:relative;float:right;width: 47%;height: 80% ;border: 1px dashed rgba(255,255,255,0.2);margin-top: 2px;padding: 10px;text-align: justify;'>";
    $string .= "<div style='text-align: justify;'>Previous : <span style='color: yellow;text-align: justify'>{$handle->getPrevious()}</span></div>";
    $string .= "<div style='text-align: justify;'>Trace String : <p style='color: yellow;text-align: justify'>{$handle->getTraceString()}</p></div>";
    $string .= "<div style='text-align: justify;'>Code : <span style='color: yellow;text-align: justify'>{$handle->getCode()}</span></div>";
    $string .= "<div style='text-align: justify;'>Line : <span style='color: yellow;text-align: justify'>{$handle->getLine()}</span></div>";
    $string .= "</div>";
    $string .= "</div>";
    $string .= "</div>";
    return $string;
}