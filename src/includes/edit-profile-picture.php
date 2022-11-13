<?php
if(!isset($_SESSION)){
    session_start();
}

//check if button clicked
if(!isset($_POST['editProfileBtn'])){
    header("location: ../login.php");
}

//Grab the data
$userId = $_SESSION['userId'];
$profileNameNew = "";
$actionMade = "Edited their profile";



if(!empty($_FILES['profile']['name'])){
    $profile = $_FILES['profile'];

    $profileName = $profile['name'];
    $profileTmpName = $profile['tmp_name'];
    $profileSize = $profile['size'];
    $profileError = $profile['error'];
    $profileType = $profile['type'];

    $profileExt = explode('.', $profileName);
    $profileActualExt = strtolower(end($profileExt));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($profileActualExt, $allowedType)){
        header("location: ../account-info.php?error=imageType1");
        exit();
    }

    if($profileError !== 0){
        header("location: ../account-info.php?error=imageError1");
        exit();
    }

    if($profileSize > 5000000){ //5000000 = 5mb
        header("location: ../account-info.php?error=imageSize1");
        exit();
    }

    $profileNameNew = uniqid('', true).".".$profileActualExt;
    $profileDestination = '../profile-uploads/'.$profileNameNew;
}





//include needed files
include "../classes/dbh.php";
include "../classes/account-info.php";
include "../classes/account-info-controller.php";
include "../classes/log.php";
include "../classes/log-controller.php";

//instantiate class
$model = new AccountInfo();
$controller = new AccountInfoController();
$logController = new LogController();

//get all old proofs
$userData = $model->getUser($userId);
$oldProfile = $userData['profile'];

//validate data and add data to the database
$controller->editProfile($userId, $profileNameNew);
$logController->addLog($userId, $actionMade);

//remove old profile
if($oldProfile != "default.jpg"){
    $imageDestination = "../profile-uploads/".$oldProfile;
    unlink($imageDestination);
}

//save new profile
move_uploaded_file($profileTmpName, $profileDestination);

//going back to page
header("location: ../account-info.php?message=updatedSuccessfully");