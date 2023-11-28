<?php

namespace App\Models;

class DatabaseModel
{
    private $host = 'localhost';
    private $dbname = 'finance-flow';
    private $username = 'root';
    private $password = 'Romain-1964';
    private $conn;

    public function connect()
    {
        try {
            $this->conn = new \PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        return $this->conn;
    }
}
