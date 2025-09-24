<?php
class Database
{
    private $connection;
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=web-php;charset=utf8mb4';
        $this->connection = new PDO($dsn, 'root', '');
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }
}
