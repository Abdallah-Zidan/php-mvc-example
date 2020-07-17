<?php


namespace controllers;
use models;

class Answer
{
    public function __construct($page)
    {
        $this->handlePost($page);
    }

    private function handlePost($page)
    {
        if(isset($_POST["submit"]) && isset($_POST["answer"])){
            $next = $page+1;
            $ans =new models\Answer();
            $res= $ans->create(["answer"=>$_POST["answer"] , "question_id"=>$page]);
            if($res)
                if ($next <= 10)
                    header("location: $next");
                else
                    header("location: /survey");
        }
    }
}