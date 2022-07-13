<?php

function server($key=null)
{
    return $key ? $_SERVER[$key] : $_SERVER;
}
