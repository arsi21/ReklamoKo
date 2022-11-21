<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
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
        .footer,
        .title {
            text-align: center;
            line-height: 0.6;
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
            /* margin: 0 3rem 0 3rem; */
            position: fixed;
            bottom: 70;
            right: 50;
            width: 80%
        }





        /* Center tables for demo */
        table {
        margin: 0 auto;
        }

        /* Default Table Style */
        table {
        color: #333;
        background: white;
        border: 1px solid grey;
        font-size: 12pt;
        border-collapse: collapse;
        }
        table thead th,
        table tfoot th {
        color: #777;
        background: rgba(0,0,0,.1);
        }
        table caption {
        padding:.5em;
        }
        table th,
        table td {
        padding: .5em;
        border: 1px solid lightgrey;
        }
        /* Zebra Table Style */
        [data-table-theme*=zebra] tbody tr:nth-of-type(odd) {
        background: rgba(0,0,0,.05);
        }
        [data-table-theme*=zebra][data-table-theme*=dark] tbody tr:nth-of-type(odd) {
        background: rgba(255,255,255,.05);
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <p><b>Republic of the Philippines</b></p>
            <p><b>Province of Nueva Ecija</b></p>
            <p><b>Municipality of Rizal</b></p>
            <p><b>Barangay Agbannawag</b></p>
        </div>

        <div class="title">
            <p><b><?= $title ?></b></p>
        </div>

            <table data-table-theme="default zebra" class="table">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Complainant/s</th>
                        <th>Complainee/s</th>
                        <th>Complaint Type</th>
                        <th>Other Details</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                foreach($datas as $row){
            ?>
                    <tr>
                        <td><?= ucwords($row['id']) ?></td>
                        <td><?= ucwords($row['complainant']) ?></td>
                        <td><?= ucwords($row['complainee']) ?></td>
                        <td><?= $row['type'] ?></td>
                        <td><?= $row['complaint_description'] ?></td>
                        <td><?= $row['date'] ?></td>
                    </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
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