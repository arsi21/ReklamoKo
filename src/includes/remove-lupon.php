<?php
//check if button clicked
if(!isset($_POST['removeBtn'])){
    header("location: ../login.php");
}

//Grab the data
$luponId = $_POST['luponId'];

//include needed files
include "../classes/dbh.php";
include "../classes/lupon-info.php";
include "../classes/lupon-info-controller.php";

//instantiate class
$controller = new LuponInfoController();

//validate data and add data to the database
$controller->removeLupon($luponId);


//going back to page
header("location: ../lupon.php");