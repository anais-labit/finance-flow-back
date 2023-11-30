<?php

namespace App\Controllers;

use App\Models\BalanceModel;

class BalanceController
{

    function intitiateBudget(int $idUser, int $initialBalance) {
        $balanceModel = new BalanceModel();
        $initialBudget = $balanceModel->setBalance($idUser, $initialBalance);
        echo json_encode($initialBudget);
      
    }

    function displayUserBalance(int $idUser)
    {
        $transactionModel = new BalanceModel();
        $result = $transactionModel->getInitialBalance($idUser);
        echo json_encode($result);
    }
   
}
