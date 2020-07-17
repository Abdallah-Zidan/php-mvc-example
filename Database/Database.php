<?php
namespace Database;
require "config.php";
ini_set('display_errors', 'Off');

// refer to the interface for helpful comments

class Database implements DBInterface
{
    private $config;
    private static $db =null;

    private function __construct($config)
    {
        $this->config = $config;
    }

    // only one instance can be created
    public static function getDB(){
       if ( self::$db == null )
           self::$db = new Database(DB_CONFIG);

       return self::$db;
    }

    function connectToDatabase()
    {
        $conn = new \mysqli($this->config["host"],
                            $this->config["user"],
                            $this->config["password"],
                            $this->config["database"],
                            $this->config["port"]);

        if ($conn->connect_errno)
        {
            $err = $conn->connect_errno."  :  ".$conn->connect_error.PHP_EOL;
            file_put_contents("./errors.log", $err, FILE_APPEND);
            return false;
        }
        return $conn;
    }

    public function insert($table,$record){
        $conn = $this->connectToDatabase();
        if (!$conn) {
            return false;
        }

       $params = array_values($record);
       $types = str_repeat("s",count($params));
       $stmt = $conn->prepare($this->prepareInsert($table,$record));
       $stmt->bind_param($types, ...$params);
       $stmt->execute();

       if ($stmt->affected_rows === 0)
           $res = false;
       else
           $res = true;
       $stmt->close();
       $conn->close();
       return $res;
    }

    function selectAll($table)
    {
        return $this->selectWhere($table) ;
    }

    function selectOne($table,$id)
    {
        $data= $this->selectWhere($table,"id", $id );
        return $data ? $data->fetch_assoc() : false;
    }

    function selectWhere( $table , $field =null , $value =null ,$op = null ){
        $conn = $this->connectToDatabase();
        $op = $op?:"=";
        if (!$conn)
            return false;
        if(!$field || !$value)
            $result = $conn->query("select * from $table;");
        else
            $result =$this->execute($conn->prepare
                ("select * from $table where $field $op ?;"),$value);
        $conn->close();
        return $result->num_rows != 0 ? $result : false;
    }

    private function execute($stmt ,$value){
        $stmt->bind_param("s", $value);
        $stmt->execute();
        return $stmt->get_result();
    }

    private function prepareInsert($table , $record){
        $query = "insert into $table (" ;
        $holders="";

        foreach ($record as $key=>$value){
            $query.="$key,";
            $holders.="?,";
        }
       return rtrim($query,",").") values (".rtrim($holders,",").");";
    }
}

