<?php
//check if button clicked
if(!isset($_POST['approveBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$luponId = $_POST['luponId'];
$scheduleDate = $_POST['scheduleDate'];
$scheduleTime = $_POST['scheduleTime'];
$ongoingDate;

//get current date
date_default_timezone_set("Asia/Manila");
$ongoingDate = date("Y-m-d");

//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();

//validate data and add data to the database
$controller->addOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate);


//going back to page
header("location: ../pending-complaints.php");