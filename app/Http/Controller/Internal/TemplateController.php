<?php

namespace App\Http\Controller\Internal;

use App\Utils\View;

class TemplateController
{
    private static function getHead()
    {
        return View::render("internal/template/head", []);
    }

    private static function getHeader()
    {
        return View::render("internal/template/header", []);
    }

    private static function getAppSidebar()
    {
        return View::render("internal/template/app-sidebar", []);
    }

    private static function getAppSidebarMobileBackdrop()
    {
        return View::render("internal/template/app-sidebar-mobile-backdrop", []);
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
        return View::render("internal/template/index", $arrayAll);
    }

    private static function getScrollToTop()
    {
        return View::render("internal/template/scroll-to-top", []);
    }

    private static function getJavascript()
    {
        return View::render("internal/template/javascript", []);
    }
}