<?php

namespace App\Models;

use PDO;

class BalanceModel
{

    public function connectDb(): PDO
    {
        $conn = new DatabaseModel;
        return $conn->connect();
    }

    public function setBalance(int $idUser, int $balance): void {
        $query = $this->connectDb()->prepare('INSERT INTO balance (user_id, balance) VALUES (:user_id, :balance)');
        $query->bindValue(':user_id', $idUser);
        $query->bindValue(':balance', $balance);
        $query->execute();
    }
    
    public function getUserbalance($idUser)
    {
        $query = 'SELECT balance FROM balance
          INNER JOIN user ON balance.user_id = user.id
          WHERE user.id = :user_id';

        $check = $this->connectDb()->prepare($query);
        $check->bindValue(':user_id', $idUser);
        $check->execute();

        $balance = $check->fetch(PDO::FETCH_ASSOC);

        return $balance;
    }
    
    public function updateBalance($idUser, $newBalance)
    {
        $query = $this->connectDb()->prepare('UPDATE balance SET balance = :balance WHERE user_id = :user_id');
        $query->bindValue(':user_id', $idUser);
        $query->bindValue(':balance', $newBalance);
        $query->execute();
    }


}
