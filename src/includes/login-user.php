<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$mobileNumber = $_POST['mobileNumber'];
$password = $_POST['password'];
$userId;
$actionMade = "Logged in to the system";

//include needed files
include "../classes/dbh.php";
include "../classes/login.php";
include "../classes/login-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$login = new LoginController($mobileNumber, $password);
$logController = new LogController();

//validate data and login user
$login->loginUser();
$userId = $_SESSION['userId'];
$logController->addLog($userId, $actionMade);

//get the access type
$access = $_SESSION['accessType'];

//redirect to pages depends on their access type
if($access == "nonVerified"){
    header("location: ../verification.php");
}elseif($access == "pendingVerification"){
    header("location: ../application-submitted.php");
}elseif($access == "resident"){
    header("location: ../pending-complaints.php");
}elseif($access == "lupon" || $access == "admin"){
    header("location: ../dashboard.php");
}else{
    header("location: ../index.php");
}