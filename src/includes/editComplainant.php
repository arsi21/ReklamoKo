<?php
//check if button clicked
if(!isset($_POST['editComplainantBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainantIds = $_POST['complainants'];
$status = "pending";
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Edited the complainant of complaint [id={$complaintId}]";


//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new PendingComplaintInfoController();

//validate data and add data to the database
$controller->editComplainant($complaintId, $complainantIds);
$controller->editPendingComplaintStatus($complaintId, $status);

//add log
$log = new Logger();
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");


//going back to page
header("location: ../pending-complaint-info.php?id=$complaintId&message=updatedSuccessfully");