<?php

namespace App\Utils;

class View
{

    /**
     * Variables globals of views
     * @var array
     */
    private static $variablesSystem = [];

    /**
     * Responsable for init the globals the views
     * @param $vars
     * @return void
     */
    public static function init($vars = [])
    {
        self::$variablesSystem = $vars;
    }

    /**
     * Responsable for get the content of file .html
     * @param $view
     * @return false|string
     */
    private static  function getContentView($view)
    {
        $view = str_replace(["."],["/"], $view);
        $file = env("ROOT_PATH")."/resources/view/".$view.".html";
        return file_exists($file) ? file_get_contents($file) : "";
    }

    /**
     * @param $view
     * @param array $vars (string/numeric)
     * @return false|string
     */
    public static function render($view, $vars = [])
    {
        $contentView = self::getContentView($view);
        $vars = array_merge_recursive(self::$variablesSystem, $vars);
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'.$item.'}}';
        }, $keys);
        return str_replace($keys, array_values($vars), $contentView);
    }

    /**
     * @param $view
     * @param array $vars (string/numeric)
     * @return false|string
     */
    public static function component($view, $vars = [])
    {
        $contentView = self::getContentView($view);
        $vars = array_merge_recursive(self::$variablesSystem, $vars);
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'.$item.'}}';
        }, $keys);
        return str_replace($keys, array_values($vars), $contentView);
    }
}