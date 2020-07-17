<?php


namespace models;

class Choice extends Model{
    // return choices in a custom way
    public function listChoices($page){
        $data = parent::findWhere("question_id",$page);

        $choices = array();

        foreach ($data as $choice){
            $cur = $choice["choice"];
            $choices[$cur] = $cur;
        }

        return $choices;
    }

}