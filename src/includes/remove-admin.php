<?php
//check if button clicked
if(!isset($_POST['removeBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}


//Grab the data
$id = $_POST['userId'];
$userId = $_SESSION['userId'];
$actionMade = "Removed admin [id={$userId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/admin-account-info.php";
include "../classes/admin-account-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new AdminAccountInfoController();
$logController = new LogController();

//validate data and add data to the database
$controller->editAccessType($id);
$logController->addLog($userId, $actionMade);


//going back to page
header("location: ../admin-accounts.php?message=removedSuccessfully");