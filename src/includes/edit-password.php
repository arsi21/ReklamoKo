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
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$actionMade = "Edited their password";

//include needed files
include "../classes/dbh.php";
include "../classes/account-info.php";
include "../classes/account-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new AccountInfoController();

//validate data and add data to the database
$controller->editPassword($userId, $password, $confirmPassword);

//add log
$log = new Logger();
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

//going back to page
header("location: ../account-info.php?message=updatedSuccessfully");