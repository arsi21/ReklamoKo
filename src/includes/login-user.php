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

//validate data and signup user
$login->loginUser();

//going back to signup page
header("location: ../dashboard.php");