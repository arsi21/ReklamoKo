<?php
//check if button clicked
if(!isset($_POST['approveBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$applicationId = $_POST['applicationId'];
$userId = $_POST['userId'];
$residentId = $_POST['residentId'];
$number = $_POST['number'];
$status = "approved";
$accessType = "resident";
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Approved application [id={$applicationId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/submitted-application-info.php";
include "../classes/submitted-application-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new SubmittedApplicationInfoController();

//validate data and add data to the database
$controller->editApplicationStatus($applicationId, $status);
$controller->editUserAccessType($userId, $accessType);
$controller->editMobileNumber($residentId, $number);

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

$CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your application for an account has been approved by the admin. You can now log in and report a complaint easily.";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($number, $CONTENT);

//going back to page
header("location: ../submitted-applications.php?message=approvedSuccessfully");