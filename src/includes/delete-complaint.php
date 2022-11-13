<?php
//check if button clicked
if(!isset($_POST['deleteBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$complaintId = $_POST['complaintId'];
$userId = $_SESSION['userId'];
$actionMade = "Deleted the complaint [id={$complaintId}]";

//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();
$logController = new LogController();

//validate data and add data to the database
$controller->removeComplaint($complaintId);
$logController->addLog($userId, $actionMade);

//remove proof image in proof-uploads folder
if(!empty($_POST['proof1'])){
    $proof1 = $_POST['proof1'];
    $imageDestination = "../proof-uploads/".$proof1;
    unlink($imageDestination);
}

if(!empty($_POST['proof2'])){
    $proof2 = $_POST['proof2'];
    $imageDestination = "../proof-uploads/".$proof2;
    unlink($imageDestination);
}

if(!empty($_POST['proof3'])){
    $proof3 = $_POST['proof3'];
    $imageDestination = "../proof-uploads/".$proof3;
    unlink($imageDestination);
}

//going back to page
header("location: ../pending-complaints.php?message=deletedSuccessfully");