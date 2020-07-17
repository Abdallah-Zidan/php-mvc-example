<?php
require "./loader.php";

use \src\lib\Util;

$uri = $_SERVER["REQUEST_URI"];

$controller = str_replace("/survey/", "", $uri);
$components = explode("/", trim($controller));

if ((count($components) === 1) || (count($components) === 2 && $components[1]==="" && $components[0] == "question"))
{
    die(Util::viewIndex());
}

else if(count($components) < 3 || (count($components) === 3 && $components[2]==="")){
        if(intval($components[1])!=0){

            $page = intval($components[1]);
            unset($components[1]);
            array_unshift($components, "controllers");

            $components[count($components) - 1] = ucfirst($components[count($components) - 1]);
            $controller = implode('\\', $components);
            $path = implode('/', $components) . '.php';

            if (!is_file($path))
              die(Util::viewNotFound());

            new $controller($page);
        }
        else
            die(Util::viewNotFound());
}

else
    die(Util::viewNotFound());
