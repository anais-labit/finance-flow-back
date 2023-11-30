<?php
header('Access-Control-Allow-Origin: *');
require_once './vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\TransactionController;
use App\Controllers\BalanceController;


if (isset($_POST['submitRegisterForm'])) {
    $registration = new UserController;
    $registration->newUser($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['confPassword']);
    die();
}

if (isset($_POST['submitLoginForm'])) {
    $connexion = new UserController();
    $connexion->logIn($_POST['login'], $_POST['password']);
    die();
}

if (isset($_POST['submitBalanceForm'])) {
    $userId = $_POST['user_id'];
    $initialBalance = $_POST['initial_amount'];
    $balance = new BalanceController();
    $balance->intitiateBudget($userId, $initialBalance);
    die();
}

if (isset($_GET['getSubcategories'])) {
    $transactionController = new TransactionController();
    $transactionController->getSubcategories();
    die();
}

if (isset($_POST['submitAddTransactionForm'])) {
    $transactionController = new TransactionController();
    $userId = $_POST['user_id'];
    $idSubCategory = $_POST['subcategory_id'];
    $stringDate = $_POST['date'];
    $date = new DateTime($stringDate);
    $transactionName = $_POST['title'];
    $amount = $_POST['amount'];
    $transactionController->addNewTransaction(
        $userId,
        $idSubCategory,
        $date,
        $transactionName,
        $amount
    );
    die();
}

if (isset($_GET['getUserTransactions'])) {
    $userId = isset($_GET['userId']) ? $_GET['userId'] : null;
    $transactionController = new TransactionController();
    $transactions = $transactionController->displayUserTransactions($userId);
    die();
}

if (isset($_GET['getUserBalance'])) {
    $userId = isset($_GET['userId']) ? $_GET['userId'] : null;
    $balanceController = new BalanceController();
    $balance = $balanceController->displayUserBalance($userId);
    die();
}
