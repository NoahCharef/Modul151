<?php

class Database

{

    private $host = "192.168.1.126";
    private $username = "db";
    private $password = "dbpass";
    private $db_name = "schuldb";
    protected $connection;

    public function connect() {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name
                , $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Connection Error: " . $e->getMessage();

        }

        return $this->connection;
    }
}
