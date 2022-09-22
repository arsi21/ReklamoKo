<?php
//check if button clicked
if(!isset($_POST['rejectBtn'])){
    header("location: ../login.php");
}

//Grab the data
$applicationId = $_POST['applicationId'];

$status = "rejected";

//include needed files
include "../classes/dbh.php";
include "../classes/submitted-application-info.php";
include "../classes/submitted-application-info-controller.php";

//instantiate class
$controller = new SubmittedApplicationInfoController();

//validate data and add data to the database
$controller->editApplicationStatus($applicationId, $status);

//going back to page
header("location: ../submitted-applications.php");