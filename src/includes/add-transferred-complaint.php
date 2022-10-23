<?php
//check if button clicked
if(!isset($_POST['transferredBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainant = $_POST['complainant'];
$complainee = $_POST['complainee'];
$complainantNumber = $_POST['complainantNumber'];
$complaineeNumber = $_POST['complaineeNumber'];
$type = $_POST['type'];
$transferredDate;

//get current date
date_default_timezone_set("Asia/Manila");
$transferredDate = date("Y-m-d");

//include needed files
include "../classes/dbh.php";
include "../classes/ongoing-complaint-info.php";
include "../classes/ongoing-complaint-info-controller.php";

//instantiate class
$controller = new OngoingComplaintInfoController();

//validate data and add data to the database
$controller->addTransferredComplaint($complaintId, $transferredDate);

//for sending message
$COMPLAINANT_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your complaint against {$complainee} has been transferred to the police.";
$COMPLAINEE_CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. The complaint against to you has been transferred to the police.";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($complainantNumber, $COMPLAINANT_CONTENT);
$smsSender->sendSms($complaineeNumber, $COMPLAINEE_CONTENT);

//going back to page
header("location: ../transfer-complaint-pdf.php?message=markedAsTransferredSuccessfully&complainant=$complainant&complainee=$complainee&type=$type&date=$transferredDate");