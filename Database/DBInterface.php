<?php
namespace Database;
interface DBInterface {

    function connectToDatabase();

    /*
     * @param : $table->  table name in database
     */
    function selectAll($table);

    /*
    * @param : $table -> table name in database
    * @param : $id -> record id
    */
    function selectOne($id,$table);

    /*
     * custom query function
     * @param : $table -> table name in database
     * @param : $field -> column name in table [null will select the whole table]
     * @param : $value -> the value to be used for filtering [null will select the whole table]
     * @param : $op -> the filtering operator [null will lead to default "=" operator]
     */
    function selectWhere( $table , $field =null , $value =null ,$op = null );

    /*
     * this method can insert any associative array represents a record in a specified table
     * and generate the required query statement dynamically.
     * @param : $table ->  table name in database
     * @param : $record -> the associative array that
     * represents the record [column_name => value , ........]
     */
    public function insert($table,$record);

}
