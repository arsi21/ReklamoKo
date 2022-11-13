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
$actionMade = "Added resident [id={$residentId}] as pacification committee";


//include needed files
include "../classes/dbh.php";
include "../classes/lupon.php";
include "../classes/lupon-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new LuponController();
$logController = new LogController();

//validate data and add data to the database
$controller->addLupon($residentId);
$logController->addLog($userId, $actionMade);

//going back to page
header("location: ../lupon.php?message=addedSuccessfully");