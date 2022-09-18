<?php
//check if button clicked
if(!isset($_POST['nextMeetingBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$scheduleDate = $_POST['scheduleDate'];
$scheduleTime = $_POST['scheduleTime'];

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint-info.php";
include "../classes/ongoing-complaint-info-controller.php";

//instantiate class
$controller = new OngoingComplaintInfoController();

//validate data and add data to the database
$controller->addMeetingSchedule($complaintId, $scheduleDate, $scheduleTime);

//going back to page
header("location: ../ongoing-complaint-info.php?id=$complaintId");