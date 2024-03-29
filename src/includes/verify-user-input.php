<?php
 //start session
 if(!isset($_SESSION)){
    session_start();
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
$controller = new SignupController($mobileNumber, $password, $confirmPassword, $agreeTerms);

$response = array('result' => '');

//validate dat
$response['result'] = $controller->verifyInput();

if($response['result']  == "none"){
    $otp = "123456"; 
    //$otp = rand(100000,999999); 
    $_SESSION['otp'] = $otp;
    $CONTENT = "Barangay AGBANNAWAG ReklamoKo website OTP is {$otp}";

    include "../classes/sms-sender.php";

    $smsSender = new SmsSender();
    //for sending sms
    $smsSender->sendSms($mobileNumber, $CONTENT);
}

echo json_encode($response);