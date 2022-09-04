<?php
//check if button clicked
if(!isset($_POST['submitBtn'])){
    header("location: ../login.php");
}

 //start session
 if(!isset($_SESSION)){
    session_start();
}

//Grab the data
$userId = $_SESSION['userId'];
$firstName = $_POST['firstName'];
$middleName = "";
$lastName = $_POST['lastName'];
$suffix = "";
$birthDate = $_POST['birthDate'];
$gender = $_POST['gender'];
$position = $_POST['position'];

if(isset($_POST['middleName'])){
    $middleName = $_POST['middleName'];
}

if(isset($_POST['suffix'])){
    $suffix = $_POST['suffix'];
}

if(!empty($_FILES['frontId']['name'])){
    $frontId = $_FILES['frontId'];

    $frontIdName = $frontId['name'];
    $frontIdTmpName = $frontId['tmp_name'];
    $frontIdSize = $frontId['size'];
    $frontIdError = $frontId['error'];
    $frontIdType = $frontId['type'];

    $frontIdExt = explode('.', $frontIdName);
    $frontIdActualExt = strtolower(end($frontIdExt));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($frontIdActualExt, $allowedType)){
        header("location: ../verification.php?error=imageType1$frontIdActualExt");
        exit();
    }

    if($frontIdError !== 0){
        header("location: ../verification.php?error=imageError1");
        exit();
    }

    if($frontIdSize > 5000000){ //5000000 = 5mb
        header("location: ../verification.php?error=imageSize1");
        exit();
    }

    $frontIdNameNew = uniqid('', true).".".$frontIdActualExt;
    $frontIdDestination = '../id-uploads/'.$frontIdNameNew;
}else{
    header("location: ../verification.php?error=emptyImage");
}

if(!empty($_FILES['backId']['name'])){
    $backId = $_FILES['backId'];

    $backIdName = $backId['name'];
    $backIdTmpName = $backId['tmp_name'];
    $backIdSize = $backId['size'];
    $backIdError = $backId['error'];
    $backIdType = $backId['type'];

    $backIdExt = explode('.', $backIdName);
    $backIdActualExt = strtolower(end($backIdExt));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($backIdActualExt, $allowedType)){
        header("location: ../verification.php?error=imageType2");
        exit();
    }

    if($backIdError !== 0){
        header("location: ../verification.php?error=imageError2");
        exit();
    }

    if($backIdSize > 5000000){ //5000000 = 5mb
        header("location: ../verification.php?error=imageSize2");
        exit();
    }

    $backIdNameNew = uniqid('', true).".".$backIdActualExt;
    $backIdDestination = '../id-uploads/'.$backIdNameNew;
}else{
    header("location: ../verification.php?error=emptyImage");
}

if(!empty($_FILES['portraitPhoto']['name'])){
    $profile = $_FILES['portraitPhoto'];

    $profileName = $profile['name'];
    $profileTmpName = $profile['tmp_name'];
    $profileSize = $profile['size'];
    $profileError = $profile['error'];
    $profileType = $profile['type'];

    $profileExt = explode('.', $profileName);
    $profileActualExt = strtolower(end($profileExt));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($profileActualExt, $allowedType)){
        header("location: ../verification.php?error=imageType3");
        exit();
    }

    if($profileError !== 0){
        header("location: ../verification.php?error=imageError3");
        exit();
    }

    if($profileSize > 5000000){ //5000000 = 5mb
        header("location: ../verification.php?error=imageSize3");
        exit();
    }

    $profileNameNew = uniqid('', true).".".$profileActualExt;
    $profileDestination = '../portrait-uploads/'.$profileNameNew;
}else{
    header("location: ../verification.php?error=emptyImage");
}

//include needed files
include "../classes/dbh.php";
include "../classes/verification.php";
include "../classes/verification-controller.php";

//instantiate class
$verification = new VerificationController($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $position, $frontIdNameNew, $backIdNameNew, $profileNameNew);

//validate data and add data to the database
$verification->addApplication();

//save images
move_uploaded_file($frontIdTmpName, $frontIdDestination);
move_uploaded_file($backIdTmpName, $backIdDestination);
move_uploaded_file($profileTmpName, $profileDestination);

//going back to page
header("location: ../application-submitted.php");