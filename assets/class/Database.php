<?php

/**
 * Class Database
 *
 * This class is the main class of Database management.
 */
class Database
{

    private $pdo;

    /**
     * Database constructor
     * Initialization of database.
     *
     * @param $login
     * @param $password
     * @param $database_name
     * @param string $host
     */
    public function __construct($login, $password, $database_name, $host = 'localhost')
    {
        $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * Main function on Database class
     * She send a custom query on database.
     *
     * @param $query
     * @param bool|array $params
     * @return bool|false|PDOStatement
     */
    public function query($query, $params = false)
    {
        if ($params) {
            $req = $this->pdo->prepare($query);
            $req->execute($params);
        } else {
            $req = $this->pdo->query($query);
        }
        return $req;
    }
}