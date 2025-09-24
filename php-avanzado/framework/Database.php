<?php
class Database
{
    private $connection;
    private $statement; //sentencia 
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=web-php;charset=utf8mb4';
        $this->connection = new PDO($dsn, 'root', '');
    }

    public function query($sql, $params = [])
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);

        return $this;
        // return $this->connection->query($sql);
    }
    public function get()
    {
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function fisrtOrFail()
    {
        $result = $this->statement->fetch(PDO::FETCH_OBJ);
        if (!$result) {
            http_response_code(404);
            exit('No encontrado');
        }
        return $result;
    }
}
