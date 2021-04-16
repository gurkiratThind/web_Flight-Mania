<?php

class database
{
    public $db_host = 'localhost';
    public $db_user_name = 'root';
    public $db_name = 'flights';
    public $db_user_pw = 'JAVA9924#';
    public $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user_name, $this->db_user_pw);
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            exit();
        }
    }

    public function query($sql_str)
    {
        try {
            $result = $this->connection->query($sql_str);
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            exit();
        }

        return $result;
    }

    //query select for converted in php array
    public function querySelect($sql_str)
    {
        $records = $this->query($sql_str)->fetchAll();

        return $records;
    }

    //return the whole table from db
    public function table($table_name)
    {
        return $this->querySelect("SELECT * FROM $table_name");
    }

    public function disconnect()
    {
        $this->connection = null;
    }

    public function queryParam($sql_str, $params)
    {
        $stmt = $this->connection->prepare($sql_str);
        $stmt->execute($params);

        return true;
    }

    public function querySelectParam($sql_str, $params)
    {
        $stmt = $this->connection->prepare($sql_str);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
