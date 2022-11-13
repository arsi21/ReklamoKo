<?php
//check if button clicked
if(!isset($_POST['editComplaintTypeBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complaintTypeId = $_POST['complaintTypeId'];
$status = "pending";
$userId = $_SESSION['userId'];
$actionMade = "Edited the complaint type of complaint [id={$complaintId}]";


//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();
$logController = new LogController();

//validate data and add data to the database
$controller->editComplaintType($complaintId, $complaintTypeId);
$controller->editPendingComplaintStatus($complaintId, $status);
$logController->addLog($userId, $actionMade);


//going back to page
header("location: ../pending-complaint-info.php?id=$complaintId&message=updatedSuccessfully");