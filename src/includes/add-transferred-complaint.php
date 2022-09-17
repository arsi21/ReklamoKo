<?php
//check if button clicked
if(!isset($_POST['transferredBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$transferredDate;

//get current date
date_default_timezone_set("Asia/Manila");
$transferredDate = date("Y-m-d");

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint.php";
include "../classes/ongoing-complaint-controller.php";

//instantiate class
$controller = new OngoingComplaintController();

//validate data and add data to the database
$controller->addTransferredComplaint($complaintId, $transferredDate);

//going back to page
header("location: ../ongoing-complaints.php");