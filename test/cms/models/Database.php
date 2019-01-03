<?php
class Database {
    private static $_instance;
    private $pdo,$last_insert_id;
    
    private function __construct(){
        try{
            $this->pdo = new PDO("mysql:host=".DB_URL.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        }
        catch(PDOException $exception){
            $exception->getMessage();
        }
    }
    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    public function getLastInsert(){
        return $this->last_insert_id;
    }
    public function select($table,$columns=array('*'),$filter=''){
        $column_names='';
        foreach ($columns as $value){
            $column_names .= $value.',';    //makes a string from the array of column names 
        }
        $column_names = rtrim($column_names,',');           //removes the last comma from the string
        $sql = "SELECT {$column_names} FROM {$table} {$filter};";
        if($query = $this->pdo->query($sql)){
            return $query->fetchAll(PDO::FETCH_ASSOC);//returns an associative array of the results
        }
        else {
          print_r($this->pdo->errorInfo());}
          return false;
        }
    public function insert($table,$columns,$values){
        if (count($columns) != count($values)) {
            return false;
        }
        $column_names = '';
        $column_values = '';
        foreach ($columns as $names){
            $column_names .= $names.",";
            $column_values .= '?,';
        }
        $column_names = rtrim($column_names,',');
        $column_values = rtrim($column_values,','); //trims the last commas from the string
        $sql = "INSERT INTO {$table} ({$column_names}) VALUES ({$column_values})";
        $query = $this->pdo->prepare($sql);
        if($query->execute($values)){
           $this->last_insert_id = $this->pdo->lastInsertId();
           return true;
        }
        else{ 
            print_r($query->errorInfo());
            return false;
        }
    }
    public function update($table, $dataArray, $filter=''){
        $values = array_values($dataArray);
        if(count($dataArray)){
            $columns = "";
            foreach ($dataArray as $key => $value){
                $columns .= "{$key}='{$value}',";
            }
            $columns = rtrim($columns,",");
            $sql = "UPDATE {$table} SET {$columns} {$filter}";
            $query = $this->pdo->prepare($sql);
        }
        if($query->execute($values)){
            return true;
        }
        else{ print_r ($this->pdo->errorInfo());echo BR.$sql.BR;}
    }
    public function delete($table,$filter=''){
        $sql = "DELETE FROM {$table} {$filter}";
        if($this->pdo->query($sql)){
           return true; 
        }
    }
}
