<?php
// element types
namespace src\lib;

define("TEXT_BOX" , 1);
define ("EMAIL_BOX",2);
define ("SELECT_BOX",3);
define ("RADIO_GROUP",4);
define("TEXT_AREA",5);
define("SUBMIT",6);

// default bootstrap classes
define("BOX_BS",["div"=>"form-group" , "input"=>"form-control"]);
define("EMAIL_BS",["div"=>"form-group" , "input"=>"form-control"]);
define("SELECT_BS",["div"=>"form-group" , "select"=>"custom-select"]);
define("TEXT_BS",["div"=>"input-group my-3" , "textarea"=>"form-control"]);
define("RADIO_BS",["div"=>"form-check form-group"  , "label"=>"form-check-label"]);
define("SUBMIT_BS",["input"=>"btn-lg btn-primary px-5" ]);