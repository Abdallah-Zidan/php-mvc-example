<?php


namespace src\lib;

/*
 * an util class for helper methods
 */

class Util
{
    private function __construct(){}

    static function viewNotFound()
    {
        return self::view("views/404.html", "page not found");
    }

    static function viewIndex()
    {
        return self::view("views/index.html", "index");
    }


    public static function loadLayout($title)
    {
        $layout = file_get_contents("views/layout.html");
        $layout = str_replace("{%title%}", $title, $layout);
        return $layout;
    }

    public static function view($path, $title)
    {
        $layout = self::loadLayout($title);
        return str_replace("{%content%}", file_get_contents($path), $layout);
    }

}