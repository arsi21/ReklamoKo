<?php
//check if button clicked
if(!isset($_POST['deleteBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];

//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();

//validate data and add data to the database
$controller->removeComplaint($complaintId);

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