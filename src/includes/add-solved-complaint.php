<?php
//check if button clicked
if(!isset($_POST['solvedBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainantNumber = $_POST['complainantNumber'];
$complaineeNumber = $_POST['complaineeNumber'];
$complainee = $_POST['complainee'];
$solvedDate;
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Added complaint [id={$complaintId}] to solved";

//get current date
date_default_timezone_set("Asia/Manila");
$solvedDate = date("Y-m-d");

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint-info.php";
include "../classes/ongoing-complaint-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new OngoingComplaintInfoController();

//validate data and add data to the database
$controller->addSolvedComplaint($complaintId, $solvedDate);

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");


//for sending message
$COMPLAINANT_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your complaint against {$complainee} has been marked as solved.";
$COMPLAINEE_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. The complaint against to you has been marked as solved.";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($complainantNumber, $COMPLAINANT_CONTENT);
$smsSender->sendSms($complaineeNumber, $COMPLAINEE_CONTENT);

//going back to page
header("location: ../ongoing-complaints.php?message=markedAsSolvedSuccessfully");