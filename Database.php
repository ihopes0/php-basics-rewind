<?php

class Database 
{

    public $connection;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=myapp;charset=utf8mb4";
        $this->connection = new PDO($dsn, 'root');
        
    }

    public function query(string $query) {
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;

    }
}