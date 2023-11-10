<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class TransactionController
{

    public function getSubcategories()
    {
        $transactionModel = new TransactionModel();
        $subcategories = $transactionModel->getSubcategories();
        $subcategoriess = json_encode(['subcategories' => $subcategories]);
        echo $subcategoriess;
    }


    public function addNewTransaction(string $transactionName, int $idUser): void
    {
        $transactionModel = new TransactionModel();
        $newTransactionName = strtolower(trim(htmlspecialchars($transactionName)));
        $newTransactionName = ucwords($newTransactionName);

        if (!empty($newTransactionName)) {
            $transactionModel->addTransaction($newTransactionName, $idUser);
            echo json_encode([
                "success" => true,
                "message" => "Transaction ajoutée !"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "La transaction doit porter un nom."
            ]);
        }
    }

    // function displayUserTransactions(int $idUser)
    // {
    //     $transactionModel = new TransactionModel();
    //     $result = $transactionModel->getUserTransactions($idUser);
    //     echo json_encode($result);
    // }


    // function deleteList(string $idList, int $idUser): void
    // {
    //     $delete = new ListModel();
    //     $delete->deleteLists($idList, $idUser);

    //     echo json_encode(['message' => 'Liste et tâches supprimées !']);
    // }
}
