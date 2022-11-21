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
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Removed admin [id={$userId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/admin-account-info.php";
include "../classes/admin-account-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new AdminAccountInfoController();

//validate data and add data to the database
$controller->editAccessType($id);

//add log
$log = new Logger();
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");


//going back to page
header("location: ../admin-accounts.php?message=removedSuccessfully");