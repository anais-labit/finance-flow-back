<?php

namespace App\Models;

use PDO;
use DateTime;

class TransactionModel
{

    private ?int $id;
    private ?int $userId;
    private ?int $subCategoryId;
    private ?DateTime $date;
    private ?string $title;
    private ?int $amount;

    public function __construct($id = null, $idUser = null, $idSubCategory = null, $date = null, $title = null, $amount = null)
    {
        $this->id = $id;
        $this->userId = $idUser;
        $this->subCategoryId = $idSubCategory;
        $this->date = $date;
        $this->title = $title;
        $this->amount = $amount;
    }

    public function connectDb(): PDO
    {
        $conn = new DatabaseModel;
        return $conn->connect();
    }

    public function getSubcategories()
    {
        $query = 'SELECT id, name FROM subcategory ORDER BY name ASC';

        $check = $this->connectDb()->prepare($query);
        $check->execute();

        $subcategories = $check->fetchAll(PDO::FETCH_ASSOC);

        return $subcategories;
    }

    public function getUserTransactions($idUser)
    {
        $query = 'SELECT 
              transaction.id,
              transaction.name,
              transaction.amount,
              transaction.subcategory_id,
              subcategory.name AS subcategory_name, 
              transaction.date
          FROM transaction
          INNER JOIN user ON transaction.user_id = user.id
          INNER JOIN subcategory ON transaction.subcategory_id = subcategory.id  
          WHERE user.id = :user_id
          ORDER BY transaction.id DESC';

        $check = $this->connectDb()->prepare($query);
        $check->bindValue(':user_id', $idUser);
        $check->execute();

        $transactions = $check->fetchAll(PDO::FETCH_ASSOC);

        return $transactions;
    }

    public function addTransaction(
        int $idUser,
        int $idSubCategory,
        DateTime $date,
        string $name,
        int $amount
    ): void {
        $query = $this->connectDb()->prepare('INSERT INTO transaction (user_id, subcategory_id, date, name, amount) VALUES (:user_id, :subcategory_id, :date, :name, :amount)');
        $name = ucwords($name);
        $formatedDate = $date->format('Y-m-d H:i:s');
        $query->bindValue(':user_id', $idUser);
        $query->bindValue(':subcategory_id', $idSubCategory);
        $query->bindValue(':date', $formatedDate);
        $query->bindValue(':name', $name);
        $query->bindValue(':amount', $amount);
        $query->execute();
    }
}
