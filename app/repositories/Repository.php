<?php

class Repository
{
    protected PDO $connection;

    public function __construct()
    {
        try {
            require(__DIR__ . "/../config/dbconfig.php");
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }
}