<?php
//check if button clicked
if(!isset($_POST['rejectBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$message = $_POST['message'];
$status = "rejected";

//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint.php";
include "../classes/pending-complaint-controller.php";

//instantiate class
$controller = new PendingComplaintController();

//validate data and add data to the database
$controller->editPendingComplaintStatus($complaintId, $status);
$controller->editPendingComplaintMessage($complaintId, $message);


//going back to page
header("location: ../pending-complaints.php");