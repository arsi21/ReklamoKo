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
$actionMade = "Added resident [id={$residentId}] as pacification committee";


//include needed files
include "../classes/dbh.php";
include "../classes/lupon.php";
include "../classes/lupon-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new LuponController();

//validate data and add data to the database
$controller->addLupon($residentId);

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

//going back to page
header("location: ../lupon.php?message=addedSuccessfully");