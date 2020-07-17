<?php

//spl_autoload_register(function ($class_name){
//    load_folder("controllers/",$class_name);
//});
//
//spl_autoload_register(function ($class_name){
//    load_folder("models/",$class_name);
//});
//
//spl_autoload_register(function ($class_name){
//    load_folder("src/",$class_name);
//});

//function load_folder($folder , $class_name){
//    $class_name = str_replace("\\" , "/",$class_name);
//    if(is_file($folder.$class_name.".php"))
//        require $folder.$class_name.".php";
//}

spl_autoload_register(function ($class_name){
    $class_name = str_replace("\\" , "/",$class_name);
    if(is_file($class_name.".php"))
        require $class_name.".php";
});


