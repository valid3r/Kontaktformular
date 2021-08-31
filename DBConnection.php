<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class DBConnection
{
    protected $host = '127.0.0.1';
    protected $dbname = 'kontaktformular';
    protected $user = 'root';
    protected $pass = '';
    protected $port = '3306';
    protected $charset = 'utf8mb4';
    protected $pdo;

    protected $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];

    function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->pass,
                $this->options
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
}
