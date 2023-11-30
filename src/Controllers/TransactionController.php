<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\BalanceModel;
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
        } else {
            $categoryId = $transactionModel->getCategoryIdForSubcategory($idSubCategory);

            $balanceModel = new BalanceModel();
            $currentBalance = $balanceModel->getInitialBalance($idUser);

            if (is_array($currentBalance)) {
                $currentBalance = $currentBalance['initial_balance'];
            }

            if ($categoryId == 1) {
                $newBalance = $currentBalance - $amount;
            } else {
                $newBalance = $currentBalance + $amount;
            }

            $balanceModel->updateBalance($idUser, $newBalance);

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
}
