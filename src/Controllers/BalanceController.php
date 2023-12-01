<?php

namespace App\Controllers;

use App\Models\BalanceModel;

class BalanceController
{

    function intitiateBudget(int $idUser, int $budget) {
        $balanceModel = new BalanceModel();
        $balance = $balanceModel->setBalance($idUser, $budget);
        echo json_encode($balance);
      
    }

    function displayUserBalance(int $idUser)
    {
        $transactionModel = new BalanceModel();
        $result = $transactionModel->getUserBalance($idUser);
        echo json_encode($result);
    }
   
}
