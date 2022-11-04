<?php
//check if button clicked
if(!isset($_POST['approveBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainantNumber = $_POST['complainantNumber'];
$complaineeNumber = $_POST['complaineeNumber'];
$complainee = $_POST['complainee'];
$luponId = $_POST['luponId'];
$scheduleDate = $_POST['scheduleDate'];
$scheduleTime = $_POST['scheduleTime'];
$formattedScheduleDate = date("m-d-Y", strtotime($scheduleDate));
$formattedScheduleTime = date("g:i a", strtotime($scheduleTime));
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


//for sending message
$COMPLAINANT_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your complaint against {$complainee} approved by the admin. The schedule for your meeting is on {$formattedScheduleDate} at {$formattedScheduleTime}. Please go to the barangay hall of barangay AGBANNAWAG on the said schedule.";
$COMPLAINEE_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. You have a scheduled meeting on {$formattedScheduleDate} at {$formattedScheduleTime}. This is for a complaint reported against to you. Please go to the barangay hall of barangay AGBANNAWAG on the said schedule. Failure to attend three(3) meetings will transfer the complaint to the police.";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($complainantNumber, $COMPLAINANT_CONTENT);
$smsSender->sendSms($complaineeNumber, $COMPLAINEE_CONTENT);

//going back to page
header("location: ../pending-complaints.php?message=approvedSuccessfully");