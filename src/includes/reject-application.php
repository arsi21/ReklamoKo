<?php
//check if button clicked
if(!isset($_POST['rejectBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$applicationId = $_POST['applicationId'];
$userId = $_POST['userId'];
$message = $_POST['message'];
$number = $_POST['number'];
$accessType = "nonVerified";
$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Rejected application [id={$applicationId}]";


//include needed files
include "../classes/dbh.php";
include "../classes/submitted-application-info.php";
include "../classes/submitted-application-info-controller.php";
include "../classes/logger.php";

//instantiate class
$controller = new SubmittedApplicationInfoController();

//validate data and add data to the database
$controller->removeApplication($applicationId);
$controller->editUserAccessType($userId, $accessType);

//add log
$log = new Logger();
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

$CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your application for an account has been rejected by the admin. Admin message: {$message}";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($number, $CONTENT);

//going back to page
header("location: ../submitted-applications.php?message=rejectedSuccessfully");