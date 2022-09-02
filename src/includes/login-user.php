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

//get the access type
session_start();
$access = $_SESSION['access'];

//redirect to pages depends on their access type
if($access == "nonVerified"){
    header("location: ../verification.php");
}elseif($access == "pendingVerification"){
    header("location: ../application-submitted.php");
}elseif($access == "resident"){
    header("location: ../pending-complaints.php");
}elseif($access == "official" || $access == "admin"){
    header("location: ../dashboard.php");
}else{
    header("location: ../index.php");
}