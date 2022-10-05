<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

//Grab the data
$residentId = $_POST['residentId'];


//include needed files
include "../classes/dbh.php";
include "../classes/lupon.php";
include "../classes/lupon-controller.php";

//instantiate class
$controller = new LuponController();

//validate data and add data to the database
$controller->addLupon($residentId);

//going back to page
header("location: ../lupon.php");