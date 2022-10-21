<?php
//check if button clicked
if(!isset($_POST['removeBtn'])){
    header("location: ../login.php");
}

//Grab the data
$id = $_POST['userId'];

//include needed files
include "../classes/dbh.php";
include "../classes/admin-account-info.php";
include "../classes/admin-account-info-controller.php";

//instantiate class
$controller = new AdminAccountInfoController();

//validate data and add data to the database
$controller->editAccessType($id);


//going back to page
header("location: ../admin-accounts.php?message=removedSuccessfully");