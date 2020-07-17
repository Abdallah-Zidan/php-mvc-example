<?php
namespace controllers;

use models;
use src\lib\Util;
use src\lib\View;

class Question
{
    private $page;
    public function __construct($page=null)
    {
        if (!$page){
            $page =1;
        }
        $this->page = $page;
        if($_SERVER["REQUEST_METHOD"] === "POST")
            // save answers to database
            new Answer($page);
        $this->renderView();
    }

    private function getQuestion(){
        $questionM = new models\Question();
        $question= $questionM->find($this->page);
        if(! $question){
            die(Util::viewNotFound());
        }

        return [
            "label"=>$question["question"] ,
            "required"=>true ,
            "name" => "answer",
        ];
    }

    private function getChoices(){
        $choiceM = new models\Choice();
        $choices = $choiceM->listChoices($this->page);
        return $choices;
    }

    private function renderView(){
        $data = $this->getQuestion();
        $choices = $this->getChoices();

        if ($choices){
            $data["options"] = $choices;
            $view= new View(SELECT_BOX,"Question $this->page" , $data);
        }
        else
            $view = new View(TEXT_BOX ,"Question $this->page" ,$data );

        echo $view->formView(["method"=>"post" , "action"=>""]);
    }
}