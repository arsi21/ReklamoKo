<?php
//check if button clicked
// if(!isset($_POST['submitBtn'])){
//     header("location: ../login.php");
// }

if(!isset($_SESSION)){
    session_start();
}

//Grab the data
//$datas = $_POST['data'];
$datas = array ("asdf","asdf","asdf");
$header = array("Rank","Resident Name","Total Complaints");
$reportTitle = "Residents with highest number of reported complaints";
//$residentId = $_POST['residentId'];
$userId = $_SESSION['userId'];
//$actionMade = "Added resident [id={$residentId}] as pacification committee";


//include needed files
include "../classes/dbh.php";
include "../classes/pdf-report-generator.php";

//instantiate class
$pdf= new PdfReportGenerator();

//$logController->addLog($userId, $actionMade);
$pdf->generatePdf($reportTitle, $header, $datas);