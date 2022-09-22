<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['accessType'] == "resident"){
    header("location:pending-complaints.php");
}

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';


?>
<!-- include partials -->
<?php include_once 'partials/footer.php';?>