<?php
//check if button clicked
if(!isset($_POST['editComplaintProofBtn'])){
    header("location: ../login.php");
}

//Grab the data
$complaintId = $_POST['complaintId'];
$proof1NameNew = "";
$proof2NameNew = "";
$proof3NameNew = "";
$status = "pending";



if(!empty($_FILES['proof1']['name'])){
    $proof1 = $_FILES['proof1'];

    $proof1Name = $proof1['name'];
    $proof1TmpName = $proof1['tmp_name'];
    $proof1Size = $proof1['size'];
    $proof1Error = $proof1['error'];
    $proof1Type = $proof1['type'];

    $proof1Ext = explode('.', $proof1Name);
    $proof1ActualExt = strtolower(end($proof1Ext));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($proof1ActualExt, $allowedType)){
        header("location: ../pending-complaints.php?error=imageType1");
        exit();
    }

    if($proof1Error !== 0){
        header("location: ../pending-complaints.php?error=imageError1");
        exit();
    }

    if($proof1Size > 5000000){ //5000000 = 5mb
        header("location: ../pending-complaints.php?error=imageSize1");
        exit();
    }

    $proof1NameNew = uniqid('', true).".".$proof1ActualExt;
    $proof1Destination = '../proof-uploads/'.$proof1NameNew;
}


if(!empty($_FILES['proof2']['name'])){
    $proof2 = $_FILES['proof2'];

    $proof2Name = $proof2['name'];
    $proof2TmpName = $proof2['tmp_name'];
    $proof2Size = $proof2['size'];
    $proof2Error = $proof2['error'];
    $proof2Type = $proof2['type'];

    $proof2Ext = explode('.', $proof2Name);
    $proof2ActualExt = strtolower(end($proof2Ext));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($proof2ActualExt, $allowedType)){
        header("location: ../pending-complaints.php?error=imageType2");
        exit();
    }

    if($proof2Error !== 0){
        header("location: ../pending-complaints.php?error=imageError2");
        exit();
    }

    if($proof2Size > 5000000){ //5000000 = 5mb
        header("location: ../pending-complaints.php?error=imageSize2");
        exit();
    }

    $proof2NameNew = uniqid('', true).".".$proof2ActualExt;
    $proof2Destination = '../proof-uploads/'.$proof2NameNew;
}


if(!empty($_FILES['proof3']['name'])){
    $proof3 = $_FILES['proof3'];

    $proof3Name = $proof3['name'];
    $proof3TmpName = $proof3['tmp_name'];
    $proof3Size = $proof3['size'];
    $proof3Error = $proof3['error'];
    $proof3Type = $proof3['type'];

    $proof3Ext = explode('.', $proof3Name);
    $proof3ActualExt = strtolower(end($proof3Ext));//get the extension

    $allowedType = array('jpg', 'jpeg', 'png');

    if(!in_array($proof3ActualExt, $allowedType)){
        header("location: ../pending-complaints.php?error=imageType3");
        exit();
    }

    if($proof3Error !== 0){
        header("location: ../pending-complaints.php?error=imageError3");
        exit();
    }

    if($proof3Size > 5000000){ //5000000 = 5mb
        header("location: ../pending-complaints.php?error=imageSize3");
        exit();
    }

    $proof3NameNew = uniqid('', true).".".$proof3ActualExt;
    $proof3Destination = '../proof-uploads/'.$proof3NameNew;
}




//include needed files
include "../classes/dbh.php";
include "../classes/pending-complaint-info.php";
include "../classes/pending-complaint-info-controller.php";

//instantiate class
$model = new PendingComplaintInfo();
$controller = new PendingComplaintInfoController();

//get all old proofs
$oldProofs = $model->getComplaintProofs($complaintId);

//validate data and add data to the database
$controller->editComplaintProof($complaintId, $proof1NameNew, $proof2NameNew, $proof3NameNew);
$controller->editPendingComplaintStatus($complaintId, $status);

//remove old proof
foreach($oldProofs as $proof){
    $imageDestination = "../proof-uploads/".$proof;
    unlink($imageDestination);
}

//save new proof
if(!empty($_FILES['proof1']['name'])){
    move_uploaded_file($proof1TmpName, $proof1Destination);
}

if(!empty($_FILES['proof2']['name'])){
    move_uploaded_file($proof2TmpName, $proof2Destination);
}

if(!empty($_FILES['proof3']['name'])){
    move_uploaded_file($proof3TmpName, $proof3Destination);
}

//going back to page
header("location: ../pending-complaint-info.php?id=$complaintId&message=updatedSuccessfully");