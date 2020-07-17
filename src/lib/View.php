<?php

namespace src\lib;
require "elements.php";

class View
{
    private $viewElement;
    private $title;
    private $data;

    public function __construct($viewElement, $title, $data = null)
    {
        $this->viewElement = $viewElement;
        $this->title = $title;
        $this->data = $data;
    }


    function formView($options)
    {
        $form = FormCreator::makeForm($options);
        FormCreator::addElement($this->viewElement,$form,$this->data);
        FormCreator::addElement(SUBMIT,$form,["value"=>"Answer"]);

        $layout = Util::loadLayout($this->title);

        return str_replace("{%content%}", $form, $layout);
    }
}

