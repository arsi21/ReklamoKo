<?php
//check if button clicked
if(!isset($_POST['rejectBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainantNumber = $_POST['complainantNumber'];
$complainee = $_POST['complainee'];
$message = $_POST['message'];
$status = "rejected";

//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();

//validate data and add data to the database
$controller->editPendingComplaintStatus($complaintId, $status);
$controller->addComment($complaintId, $message);


$CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your complaint against {$complainee} rejected by the admin. Message of the admin: {$message}";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();
//for sending sms
$smsSender->sendSms($complainantNumber, $CONTENT);

//going back to page
header("location: ../pending-complaints.php?message=rejectedSuccessfully");