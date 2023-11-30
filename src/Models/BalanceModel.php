<?php

namespace App\Models;

use PDO;

class BalanceModel
{
    private ?int $id;
    private ?string $login;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $password;
    private ?int $row;
    private ?int $role;

    public function __construct($id = null, $login = null, $firstname = null, $lastname = null, $password = null, $role = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->role = $role;
    }

    public function connectDb(): PDO
    {
        $conn = new DatabaseModel;
        return $conn->connect();
    }

    public function setBalance(int $idUser, int $initialBalance): void {
        $query = $this->connectDb()->prepare('INSERT INTO balance (user_id, initial_balance) VALUES (:user_id, :initial_balance)');
        $query->bindValue(':user_id', $idUser);
        $query->bindValue(':initial_balance', $initialBalance);
        $query->execute();
    }
    
    public function getCurrentBalanceTransaction($idUser)
    {
        $query = 'SELECT initial_balance FROM balance
          INNER JOIN user ON balance.user_id = user.id
          WHERE user.id = :user_id';

        $check = $this->connectDb()->prepare($query);
        $check->bindValue(':user_id', $idUser);
        $check->execute();

        $balance = $check->fetch(PDO::FETCH_ASSOC);

        return $balance;
    }

}