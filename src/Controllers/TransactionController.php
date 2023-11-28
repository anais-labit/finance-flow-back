<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use DateTime;

class TransactionController
{

    public function getSubcategories()
    {
        $transactionModel = new TransactionModel();
        $subcategories = $transactionModel->getSubcategories();
        $subcategoriess = json_encode(['subcategories' => $subcategories]);
        echo $subcategoriess;
    }

    function displayUserTransactions(int $idUser)
    {
        $transactionModel = new TransactionModel();
        $result = $transactionModel->getUserTransactions($idUser);        
        echo json_encode($result);
    }

    public function addNewTransaction(
        int $idUser,
        int $idSubCategory,
        DateTime $date,
        string $transactionName,
        int $amount
    ): void {
        $transactionModel = new TransactionModel();
        $newTransactionName = strtolower(trim(htmlspecialchars($transactionName)));
        $newTransactionName = ucwords($newTransactionName);

        if (empty($newTransactionName)) {
            echo json_encode([
                "success" => false,
                "message" => "La transaction doit porter un nom."
            ]);
        // } elseif (empty($date) || ($date != '')) {
        //     echo json_encode([
        //         "success" => false,
        //         "message" => "Merci de saisir la date de la transaction."
        //     ]);
        // } elseif (empty($amount)) {
        //     echo json_encode([
        //         "success" => false,
        //         "message" => "Merci de saisir un montant."
        //     ]);
        // } elseif (empty($idSubCategory) || ($idSubCategory != '')) {
        //     echo json_encode([
        //         "success" => false,
        //         "message" => "Merci de choisir une catégorie."
        //     ]);
        } else {
            $transactionModel->addTransaction(
                $idUser,
                $idSubCategory,
                $date,
                $newTransactionName,
                $amount
            );
            echo json_encode([
                "success" => true,
                "message" => "Transaction ajoutée !"
            ]);
        }
    }




    // function deleteList(string $idList, int $idUser): void
    // {
    //     $delete = new ListModel();
    //     $delete->deleteLists($idList, $idUser);

    //     echo json_encode(['message' => 'Liste et tâches supprimées !']);
    // }
}
