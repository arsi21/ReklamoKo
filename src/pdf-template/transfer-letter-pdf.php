<?php
if(!isset($_SESSION)){
    session_start();
}
//include needed files
include "../classes/dbh.php";
include "../classes/dashboard.php";

//instantiate class
$model = new Dashboard();

$datas = $model->getComplaints();

$userName = $_SESSION['firstName']. " " .$_SESSION['lastName'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            line-height: 0.8;
        }

        .page {
            page-break-after: always;
        }

        .header,
        .date,
        .subhead,
        .complainants,
        .complainees,
        .for,
        .other-details,
        .footer {
            text-align: center;
        }

        .header {
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        .date {
            margin-bottom: 4rem;
        }

        .subhead {
            margin-bottom: 3rem;
        }

        .complainants {
            margin-bottom: 2rem;
        }

        .complainees {
            margin-bottom: 2rem;
        }

        .for {
            margin-bottom: 2rem;
        }

        .other-details {
            margin-bottom: 6rem;
        }

        .captain {
            float: left;
        }

        .prepared-by {
            float: right;
        }

        .footer {
            margin: 0 3rem 0 3rem;
        }
    </style>
</head>

<body>
<?php 
foreach ($datas as $row) {
?>
    <div class="page">
        <div class="header">
            <p><b>Republic of the Philippines</b></p>
            <p><b>Province of Nueva Ecija</b></p>
            <p><b>Municipality of Rizal</b></p>
            <p><b>Barangay Agbannawag</b></p>
        </div>

        <div class="date">
            <p><b>Date: </b><?= $row['date'] ?></p>
        </div>

        <div class="subhead">
            <p><b>OFFICE OF THE LUPONG TAGAPAMAYAPA</b></p>
        </div>

        <div class="complainants">
            <p><?= ucwords($row['complainant']) ?></p>
            <p><b>Complainant/s</b></p>
        </div>

        <div class="complainees">
            <p><?= ucwords($row['complainee']) ?></p>
            <p><b>Defendant/s</b></p>
        </div>

        <div class="for">
            <p><b>For: </b><?= $row['type'] ?></p>
        </div>

        <div class="other-details">
            <p><b>Other details: </b><?= $row['complaint_description'] ?></p>
        </div>

        <div class="footer">
            <div class="captain">
                <p>Hon. Juan Dela Cruz</p>
                <p><b>Brangay Captain</b></p>
            </div>
            <div class="prepared-by">
                <p><?= ucwords($userName) ?></p>
                <p><b>Prepared By</b></p>
            </div>
        </div>
    </div>
<?php 
}
?>
</body>

</html>