<?php
 //start session
 if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$firstName = $_POST['firstName'];
$middleName = "";
$lastName = $_POST['lastName'];
$suffix = "";
$birthDate = $_POST['birthDate'];
$gender = $_POST['gender'];

if(isset($_POST['middleName'])){
    $middleName = $_POST['middleName'];
}

if(isset($_POST['suffix'])){
    $suffix = $_POST['suffix'];
}

//include needed files
include "../classes/dbh.php";
include "../classes/verification.php";
include "../classes/verification-controller.php";

//instantiate class
$verification = new VerificationController();

$response = array('result' => '');

//validate data and add data to the database
$response['result'] = $verification->checkResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender);

echo json_encode($response);