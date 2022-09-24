<?php
//include needed files
include "../classes/dbh.php";
include "../classes/dashboard.php";

//instantiate class
$model = new Dashboard();

$complaintCountsPerStatus = $model->getComplaintCountsPerStatus();
$countsPerMonth = $model->getComplaintCountsPerMonth();
$residentAccountCounts = $model->getResidentAccountCounts();
$complaintCountsPerMonth = array (0,0,0,0,0,0,0,0,0,0,0,0);

for($i = 0; $i < 12; $i++){
    if(isset($countsPerMonth[$i]['MONTH'])){
        $index = $countsPerMonth[$i]['MONTH'] - 1;
        $complaintCountsPerMonth[$index] = $countsPerMonth[$i]['COUNT'];
    }
}

$response = array('complaintCountsPerStatus' => '', 'complaintCountsPerMonth' => '', 'residentAccountCounts' => '');

$response['complaintCountsPerStatus'] = $complaintCountsPerStatus;
$response['complaintCountsPerMonth'] = $complaintCountsPerMonth;
$response['residentAccountCounts'] = $residentAccountCounts;

echo json_encode($response);