<?php
header('Access-Control-Allow-Origin: *');
require_once './vendor/autoload.php';

use App\Controllers\UserController;

if (isset($_POST['submitRegisterForm'])) {
    $registration = new UserController;
    $registration->newUser($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['confPassword']);
    die();
}

if (isset($_POST['submitLoginForm']) && (!empty($_POST['password']))) {
    $connexion = new UserController();
    $connexion->logIn($_POST['login'], $_POST['password']);
    die();
}

