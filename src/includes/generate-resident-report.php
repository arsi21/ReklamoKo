<?php
if(!isset($_POST['submitBtn'])){
    header('location: ../dashboard.php');
}

$id = $_POST['id'];
$name = $_POST['name'];
$reportType = $_POST['reportType'];
$title;

//include needed files
include "../classes/pdf-report-generator.php";

//instantiate class
$pdf = new PdfReportGenerator();

if($reportType == 1){
    $title = "Report for all reported complaints of $name";
}elseif($reportType == 2){
    $title = "Report for all reported complaints against $name";
}

$pdf->generateComplaintReportPdf($id, $title);