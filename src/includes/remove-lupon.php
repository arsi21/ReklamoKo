<?php
//check if button clicked
if(!isset($_POST['removeBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$luponId = $_POST['luponId'];
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Removed pacification committee [id={$luponId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/lupon-info.php";
include "../classes/lupon-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new LuponInfoController();

//validate data and add data to the database
$controller->removeLupon($luponId);

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");


//going back to page
header("location: ../lupon.php?message=removedSuccessfully");