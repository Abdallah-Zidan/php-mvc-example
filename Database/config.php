<?php
// db configurations ...
/*
 * notes :
 * avoid using root user directly
 * avoid easy passwords
 * this config file must be out of document root and with read permission only
 */

define("HOST","127.0.0.1");
define ("USER","laravel");
define ("PASSWORD","laravel");
define ("DATABASE" , "survey");
define ("PORT","3306");


// only for facility declaring a CONFIG variable as an array having all the configurations
define("DB_CONFIG",array("host"=>HOST , "user"=>USER , "password"=>PASSWORD ,
    "database"=>DATABASE , "port"=>PORT));
