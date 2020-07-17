<?php

namespace Database;
/*
 * this class is just a layer between models and database for more abstraction
 * and flexibility.
 * note if you don't specify table name it can get the name from model class name
 */

class DAL
{
    private $table;
    private $db;

    public function __construct($table=null,$class=null )
    {
        if (!$table){
            if (!$class)
                die("bad table name");

            $table= $this->getDefaultTable($class);
        }

        $this->table = $table;
        $this->db = Database::getDB();
    }

    public function all(){
        $data = $this->db->selectAll($this->table);
        return $data ? $this->toArray($data) : false;
    }

    public  function find($id){
        return $this->db->selectOne($this->table, $id);
    }

    public function findWhere($field, $value, $operator = null)
    {
        $data = $this->db->selectWhere($this->table, $field, $value, $operator);
        return $data? $this->toArray($data) :false;
    }

    public function create($record){
       return  $this->db->insert($this->table,$record);
    }

    private function toArray($data)
    {
        $questions = array();
        while ($row = $data->fetch_assoc())
            $questions[] = $row;

        return $questions;
    }

    private function getDefaultTable($class)
    {
        $path = explode("\\", $class);
        $table = $path[count($path) - 1];
        $table = strtolower($table) . "s";
        return trim($table);
    }
}