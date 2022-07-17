<?php

function server($key=null)
{
    return $key ? $_SERVER[$key] : $_SERVER;
}

function env($index, $value=null)
{
    if($value) {
        $_ENV[$index] = $value;
    }
    return str_replace(["\n"],[""], $_ENV[$index]);
}
