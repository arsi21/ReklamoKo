<?php
//check if button clicked
if(!isset($_POST['nextMeetingBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$scheduleDate = $_POST['scheduleDate'];
$scheduleTime = $_POST['scheduleTime'];
$formattedScheduleDate = date("m-d-Y", strtotime($scheduleDate));
$formattedScheduleTime = date("g:i a", strtotime($scheduleTime));
$complainantNumber = $_POST['complainantNumber'];
$complaineeNumber = $_POST['complaineeNumber'];
$complainee = $_POST['complainee'];

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint-info.php";
include "../classes/ongoing-complaint-info-controller.php";

//instantiate class
$controller = new OngoingComplaintInfoController();

//validate data and add data to the database
$controller->addMeetingSchedule($complaintId, $scheduleDate, $scheduleTime);

//for sending message
$COMPLAINANT_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. You have schedule meeting on {$formattedScheduleDate} at {$formattedScheduleTime} for your complaint against {$complainee}. Please go to the barangay hall of barangay AGBANNAWAG on the said schedule.";
$COMPLAINEE_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. You have a scheduled meeting on {$formattedScheduleDate} at {$formattedScheduleTime}. This is for a complaint reported against to you. Please go to the barangay hall of barangay AGBANNAWAG on the said schedule. Failure to attend three(3) meetings will transfer the complaint to the police.";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($complainantNumber, $COMPLAINANT_CONTENT);
$smsSender->sendSms($complaineeNumber, $COMPLAINEE_CONTENT);

//going back to page
header("location: ../ongoing-complaint-info.php?id=$complaintId&message=scheduledSuccessfully");