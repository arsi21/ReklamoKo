<?php
//include needed files
include "../classes/dbh.php";
include "../classes/dashboard.php";

//instantiate class
$model = new Dashboard();

//get current year
date_default_timezone_set("Asia/Manila");
$year = date("Y");

$complaintCountsPerStatus = $model->getComplaintCountsPerStatus();
$countsPerMonth = $model->getComplaintCountsPerMonth($year);
$residentAccountCounts = $model->getResidentAccountCounts();
$complaintCountsPerMonth = array (0,0,0,0,0,0,0,0,0,0,0,0);
$residentsWithMostNumberOfComplaint = $model->getResidentsWithMostNumberOfComplaint();

for($i = 0; $i < 12; $i++){
    if(isset($countsPerMonth[$i]['MONTH'])){
        $index = $countsPerMonth[$i]['MONTH'] - 1;
        $complaintCountsPerMonth[$index] = $countsPerMonth[$i]['COUNT'];
    }
}

$response = array('complaintCountsPerStatus' => '', 'complaintCountsPerMonth' => '', 'residentAccountCounts' => '', 'mostComplainant' => '');

$response['complaintCountsPerStatus'] = $complaintCountsPerStatus;
$response['complaintCountsPerMonth'] = $complaintCountsPerMonth;
$response['residentAccountCounts'] = $residentAccountCounts;
$response['mostComplainant'] = $residentsWithMostNumberOfComplaint;

echo json_encode($response);