<?php

spl_autoload_register(function ($class_name){
    $class_name = str_replace("\\" , "/",$class_name);
    if(is_file($class_name.".php"))
        require $class_name.".php";
});


