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
$actionMade = "Removed pacification committee [id={$luponId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/lupon-info.php";
include "../classes/lupon-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new LuponInfoController();
$logController = new LogController();

//validate data and add data to the database
$controller->removeLupon($luponId);
$logController->addLog($userId, $actionMade);


//going back to page
header("location: ../lupon.php?message=removedSuccessfully");