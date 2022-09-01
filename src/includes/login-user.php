<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

//Grab the data
$mobileNumber = $_POST['mobileNumber'];
$password = $_POST['password'];

//include needed files
include "../classes/dbh.php";
include "../classes/login.php";
include "../classes/login-controller.php";

//instantiate class
$login = new LoginController($mobileNumber, $password);

//validate data and login user
$login->loginUser();

session_start();

$access = $_SESSION['access'];
if($access == "nonVerified"){
    header("location: ../verification.php");
}elseif($access == "pendingVerification"){
    header("location: ../application-submitted.php");
}else{
    header("location: ../dashboard.php?$access");
}