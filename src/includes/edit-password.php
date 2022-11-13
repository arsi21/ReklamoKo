<?php
if(!isset($_SESSION)){
    session_start();
}

//check if button clicked
if(!isset($_POST['editPasswordBtn'])){
    header("location: ../login.php");
}

//Grab the data
$userId = $_SESSION['userId'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$actionMade = "Edited their password";

//include needed files
include "../classes/dbh.php";
include "../classes/account-info.php";
include "../classes/account-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new AccountInfoController();
$logController = new LogController();

//validate data and add data to the database
$controller->editPassword($userId, $password, $confirmPassword);
$logController->addLog($userId, $actionMade);

//going back to page
header("location: ../account-info.php?message=updatedSuccessfully");