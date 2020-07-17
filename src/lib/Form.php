<?php

namespace src\lib;
class Form
{
    private $_method;
    private $_action;
    private $_form_components_html =[];

    public function __construct($options =[] , $bs_classes=[])
    {
            $bootstrap = implode(" ",$bs_classes);
            $this->_method = isset($options["method"])? $options["method"]: "GET";
            $this->_action = isset($options["action"])?$options["action"]:"#";
            $html = sprintf("<form class='$bootstrap' action='%s' method='%s'>  
                <fieldset><legend >Survey :</legend> ",
                $this->_action , $this->_method);
            $this->_form_components_html[] =$html;
    }

    private function add_input( $type , $options=[] ,  $bs_classes=[]){

        $name = isset($options["name"])?$options["name"]:"$type";
        $label = isset($options["label"])?$options["label"]:"$type";
        $required = isset($options["required"])? ($options["required"] ? "required":"") :"";
        $length =  isset($options["length"]) ? $options["length"]:30;

        $html = sprintf("<div class='{$this->get_classes($bs_classes ,"div")}'>"
            ."<label class='{$this->get_classes($bs_classes ,"label")}' for='%s' >%s</label>"
            ."<input class='{$this->get_classes($bs_classes ,"input")}'
             type='%s' maxlength='%s' name='%s' %s> </div>",
           $name , $label ,$type,$length , $name , $required);

        $this->_form_components_html[] = $html;
    }

    public function add_text_box($options=[] , $bs_classes=[]){
        $this->add_input("text",$options  , $bs_classes);
    }
    public function add_email_box($options =[] , $bs_classes=[]){
        $this->add_input("email",$options ,  $bs_classes);
    }

    public function add_select_box($options=[] , $bs_classes=[]){

        $name = isset($options["name"])?$options["name"]:"Gender";
        $select_options = isset($options["options"])?$options["options"]:[];
        $label = isset($options["label"])?$options["label"]:"select";

        $html ="<div class='{$this->get_classes($bs_classes,"div")}'>
            <label class='{$this->get_classes($bs_classes,"label")}' for='$name'>$label</label>
            <select class='{$this->get_classes($bs_classes,"select")}' name='$name'>";

        foreach ($select_options as  $key=>$option){
            $html.= "<option  class='{$this->get_classes($bs_classes,"option")}' 
            value='$key'>$option</option>";
        }

        $html.= "</select></div>";

        $this->_form_components_html[] = $html;
    }

    public function add_radio_group($options=[] , $bs_classes =[]){

        $name = isset($options["name"])?$options["name"]:"radio";
        $radio_options = isset($options["options"])?$options["options"]:[];
        $html ="";

        foreach ($radio_options as $option){
            $id = isset($option["id"])?$option["id"]:"id";
            $value = isset($option["value"])?$option["value"]:"value";
            $label = isset($option["label"])?$option["label"]:"$value";
            $checked = isset($option["checked"]) ?($option["checked"]?"checked":""):"";

            $html .="<div class='{$this->get_classes($bs_classes,"div")}'>"
                ."<label class='{$this->get_classes($bs_classes,"label")}' for='$name'>$label</label>"
                ."<input class='{$this->get_classes($bs_classes,"input")}'"
                ."id='$id'  type='radio' name='$name' $checked value='$value'></div>";
        }

        $this->_form_components_html[] = $html;
    }

    public function add_text_area($options=[] , $bs_classes=[]){
        $name = isset($options["name"])?$options["name"]:"text_area";
        $label = isset($options["name"])?$options["name"]:"text area";

        $html = sprintf("<div class='{$this->get_classes($bs_classes,"div")}'>
            <div class='input-group-prepend'><span class='input-group-text'>%s</span></div>
            <textarea class='{$this->get_classes($bs_classes,"textarea")}' name='%s' ></textarea></div>",
             $label ,$name );

        $this->_form_components_html[] = $html;
    }

    public function add_submit($options =[] , $bs_classes=[]){
        $name = isset($options["name"])?$options["name"]:"submit";
        $value =isset($options["value"])?$options["value"]:"submit";
        $html = sprintf("<input class='{$this->get_classes($bs_classes,"input")}'"
                    ."type='submit' name='%s' value='%s'>",
                    $name , $value);

        $this->_form_components_html[] = $html;
    }


    public function get_html(){
        $this->_form_components_html[] ="</fieldset></form>";
        return (implode("",$this->_form_components_html));
    }

    private  function get_classes($bs_classes , $element){
        $el_classes = isset($bs_classes[$element])? $bs_classes[$element] :"";
        return $el_classes;
    }

    public function __toString()
    {
        return $this->get_html();
    }

}