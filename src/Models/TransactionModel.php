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
    
    // public function getUserTransactions($idUser)
    // {
    //     $query = 'SELECT transaction.id, transaction.name
    //           FROM transaction
    //           INNER JOIN user ON transaction.user_id = user.id
    //           WHERE user.id = :user_id
    //           ORDER BY transaction.id DESC';

    //     $check = $this->connectDb()->prepare($query);
    //     $check->bindValue(':user_id', $idUser, PDO::PARAM_INT);
    //     $check->execute();

    //     $transactions = $check->fetchAll(PDO::FETCH_ASSOC);

    //     return $transactions;
    // }

    public function addTransaction(string $name, int $idUser): void
    {
        $query = $this->connectDb()->prepare('INSERT INTO transaction (name, user_id) VALUES (:name, :user_id)');
        $name = ucwords($name);
        $query->bindValue(':name', $name);
        $query->bindValue(':user_id', $idUser);
        $query->execute();
    }
}
