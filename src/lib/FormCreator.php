<?php


namespace src\lib;

class FormCreator
{
    private function __construct(){}

    public static function addElement($viewElement,$form ,$data=null){
        switch ($viewElement){
            case TEXT_BOX:
                $form->add_text_box($data,BOX_BS);
                break;
            case EMAIL_BOX:
                $form->add_email_box($data,EMAIL_BS);
                break;
            case SELECT_BOX:
                $form->add_select_box($data,SELECT_BS);
                break;
            case RADIO_GROUP:
                $form->add_radio_group($data,RADIO_BS);
                break;
            case TEXT_AREA:
                $form->add_text_area($data,TEXT_BS);
                break;
            case SUBMIT:
                $form->add_submit($data,SUBMIT_BS);
                break;
        }
    }
    public static function makeForm($formOptions=null){
        return new Form($formOptions);
    }
}