<?php
header('Access-Control-Allow-Origin: *');
require_once './vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\TransactionController;

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


// if (isset($_GET['getUserTransactions'])) {
//     $transactions = $transactionsController->displayUserTransactions($_SESSION['user']->getId());
//     return $transactions;
// }




// if (isset($_POST['addTaskBtn'])) {
//     $taskController->addNewTask(($_POST['newTaskName']), $_POST['dueDateNewTask'], $_POST['postId']);
//     die();
// }
