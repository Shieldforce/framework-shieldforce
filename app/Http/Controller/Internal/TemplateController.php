<?php

namespace App\Http\Controller\Internal;

use App\Utils\View;

class TemplateController
{
    private static function getHead()
    {
        return View::component("internal/template/head", []);
    }

    private static function getHeader()
    {
        return View::component("internal/template/header", []);
    }

    private static function getAppSidebar()
    {
        return View::component("internal/template/app-sidebar", []);
    }

    private static function getAppSidebarMobileBackdrop()
    {
        return View::component("internal/template/app-sidebar-mobile-backdrop", []);
    }

    public static function getTemplate($content, array $args = [])
    {
        $arrayContent = [
            "head" => self::getHead(),
            "header" => self::getHeader(),
            "app-sidebar" => self::getAppSidebar(),
            "app-sidebar-mobile-backdrop" => self::getAppSidebarMobileBackdrop(),
            "content" => $content,
            "scroll-to-top" => self::getScrollToTop(),
            "javascript" => self::getJavascript(),
        ];
        $arrayAll = array_merge($arrayContent, $args);
        return View::component("internal/template/index", $arrayAll);
    }

    private static function getScrollToTop()
    {
        return View::component("internal/template/scroll-to-top", []);
    }

    private static function getJavascript()
    {
        return View::component("internal/template/javascript", []);
    }
}