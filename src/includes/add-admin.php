<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

//Grab the data
$residentId = $_POST['residentId'];


//include needed files
include "../classes/dbh.php";
include "../classes/admin-account.php";
include "../classes/admin-account-controller.php";

//instantiate class
$controller = new AdminAccountController();

//validate data and add data to the database
$controller->editAccessType($residentId);

//going back to page
header("location: ../admin-accounts.php?message=addedSuccessfully");