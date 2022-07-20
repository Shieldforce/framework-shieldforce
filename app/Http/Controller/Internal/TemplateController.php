<?php

namespace App\Http\Controller\Internal;

use App\Utils\Request\OldFieldsFromFormsInGetRequests;
use App\Utils\View;

class TemplateController
{
    private static $prefixPath = "internal.template.";

    private static function getHead()
    {
        return View::component(self::$prefixPath."head", []);
    }

    private static function getHeader()
    {
        return View::component(self::$prefixPath."header", []);
    }

    private static function getAppSidebar()
    {
        return View::component(self::$prefixPath."app-sidebar", []);
    }

    private static function getAppSidebarMobileBackdrop()
    {
        return View::component(self::$prefixPath."app-sidebar-mobile-backdrop", []);
    }

    public static function getTemplate($content, array $args = [])
    {
        $content      = OldFieldsFromFormsInGetRequests::remove($content);
        $arrayFields  = OldFieldsFromFormsInGetRequests::add($args);
        $arrayContent = [
            "head" => self::getHead(),
            "header" => self::getHeader(),
            "app-sidebar" => self::getAppSidebar(),
            "app-sidebar-mobile-backdrop" => self::getAppSidebarMobileBackdrop(),
            "content" => $content,
            "scroll-to-top" => self::getScrollToTop(),
            "javascript" => self::getJavascript(),
        ];
        $arrayAll = array_merge($arrayContent, $args, $arrayFields);
        return View::component(self::$prefixPath."index", $arrayAll);
    }

    private static function getScrollToTop()
    {
        return View::component(self::$prefixPath."scroll-to-top", []);
    }

    private static function getJavascript()
    {
        return View::component(self::$prefixPath."javascript", []);
    }
}