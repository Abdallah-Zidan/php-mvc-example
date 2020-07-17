<?php


namespace models;

use Database\DAL;

abstract class Model
{
    protected $dal;

    public function __construct($table = null)
    {
        $this->dal = new DAL($table , get_called_class());
    }

    public function all()
    {
        return $this->dal->all();
    }

    public function find($id)
    {
        return $this->dal->find($id);
    }

    public function findWhere($field, $value, $operator = null)
    {
        return $this->dal->findWhere($field , $value , $operator);
    }

    public function create($record){
       return  $this->dal->create($record);
    }
}