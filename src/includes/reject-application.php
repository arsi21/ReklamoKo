<?php
//check if button clicked
if(!isset($_POST['rejectBtn'])){
    header("location: ../login.php");
}

//Grab the data
$applicationId = $_POST['applicationId'];
$userId = $_POST['userId'];
$message = $_POST['message'];
$number = $_POST['number'];

$accessType = "nonVerified";


//include needed files
include "../classes/dbh.php";
include "../classes/submitted-application-info.php";
include "../classes/submitted-application-info-controller.php";

//instantiate class
$controller = new SubmittedApplicationInfoController();

//validate data and add data to the database
$controller->removeApplication($applicationId);
$controller->editUserAccessType($userId, $accessType);

$CONTENT = "This message is from the barangay AGBANNAWAG ReklamoKo website. Your application for an account has been rejected by the admin. Admin message: {$message}";

include "../classes/sms-sender.php";

$smsSender = new SmsSender();

$smsSender->sendSms($number, $CONTENT);

//going back to page
header("location: ../submitted-applications.php?message=rejectedSuccessfully");