<?php
//check if button clicked
if(!isset($_POST['solvedBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$solvedDate;

//get current date
date_default_timezone_set("Asia/Manila");
$solvedDate = date("Y-m-d");

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint.php";
include "../classes/ongoing-complaint-controller.php";

//instantiate class
$controller = new OngoingComplaintController();

//validate data and add data to the database
$controller->addSolvedComplaint($complaintId, $solvedDate);

//going back to page
header("location: ../ongoing-complaints.php");