<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../signup.php");
}

//Grab the data
$mobileNumber = $_POST['mobileNumber'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$agreeTerms = $_POST['agreeTerms'];

//include needed files
include "../classes/dbh.php";
include "../classes/signup.php";
include "../classes/signup-controller.php";

//instantiate class
$signup = new SignupController($mobileNumber, $password, $confirmPassword, $agreeTerms);

//validate data and signup user
$signup->signupUser();

//redirect to other page
header("location: ../login.php");