<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}


//Grab the data
$residentId = $_POST['residentId'];
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Added resident [id={$residentId}] as admin";


//include needed files
include "../classes/dbh.php";
include "../classes/admin-account.php";
include "../classes/admin-account-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new AdminAccountController();

//validate data and add data to the database
$controller->editAccessType($residentId);

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

//going back to page
header("location: ../admin-accounts.php?message=addedSuccessfully");