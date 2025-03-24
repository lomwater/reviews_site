<?php

namespace myfrm;

use PDO;
use PDOException;

class Db
{
    private static $instance = null;
    private $connection;
    private $statement;

    public function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function getConnection(array $dbConfig)
    {
        if ($this->connection instanceof PDO) {
            return $this;
        }
        try {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
            $this->connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
            return $this;
        } catch (PDOException $e) {
            abort(500);
        }
    }

    public function query(string $query, array $params = [])
    {
        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
            return $this;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findAll(): array
    {
        return $this->statement->fetchAll();
    }

    public function findOrFail(): mixed
    {
        $result = $this->find();
        if (!$result) {
            abort();
        }
        return $result;
    }

    public function find(): mixed
    {
        return $this->statement->fetch();
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }

    public function getColumnCount()
    {
        return $this->statement->fetchColumn();
    }

    public function getInsertId(): int
    {
        return $this->connection->lastInsertId();
    }
}