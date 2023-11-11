<?php
class Database
{
    private $localhost = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "php_api_jwt";

    private $mysqli = "";
    private $result = array();
    private $conn = false;

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli(
                $this->localhost,
                $this->username,
                $this->password,
                $this->database
            );

            $this->conn = true;

            if ($this->mysqli->connect_error) {
                array_push(
                    $this->result,
                    mysqli_connect_error($this->conn)
                );
                return false;
            }
        } else {
            return true;
        }
    }
    //insert data
    public function insert($table, $params=array()){
        if($this->tableExist($table)){
            echo" Working";
        }
    }

    //table exist
    private function tableExist($table)
    {
        $sql = "SHOW TABLES FROM $this->database
        LIKE '{$table}'";

        $tableIndb = $this->mysqli->query($sql);
        if ($tableIndb) {
            if ($tableIndb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, $table . "Does not exist");
            }
        } else {
            return false;
        }
    }
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return true;
        }
    }
}
