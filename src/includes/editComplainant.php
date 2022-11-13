<?php
//check if button clicked
if(!isset($_POST['editComplainantBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$complainantIds = $_POST['complainants'];
$status = "pending";


//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";

//instantiate class
$controller = new PendingComplaintInfoController();

//validate data and add data to the database
$controller->editComplainant($complaintId, $complainantIds);
$controller->editPendingComplaintStatus($complaintId, $status);


//going back to page
header("location: ../pending-complaint-info.php?id=$complaintId&message=updatedSuccessfully");