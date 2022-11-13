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
$actionMade = "Added resident [id={$residentId}] as admin";


//include needed files
include "../classes/dbh.php";
include "../classes/admin-account.php";
include "../classes/admin-account-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new AdminAccountController();
$logController = new LogController();

//validate data and add data to the database
$controller->editAccessType($residentId);
$logController->addLog($userId, $actionMade);

//going back to page
header("location: ../admin-accounts.php?message=addedSuccessfully");