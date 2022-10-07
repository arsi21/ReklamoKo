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

//include needed files
include "../classes/dbh.php";
include "../classes/account-info.php";
include "../classes/account-info-controller.php";

//instantiate class
$controller = new AccountInfoController();

//validate data and add data to the database
$controller->editPassword($userId, $password, $confirmPassword);

//going back to page
header("location: ../account-info.php?message=updatedSuccessfully");