<?php
if(!isset($_POST['search'])){
    header("location: ../pending-complaints.php");
}

if(!isset($_SESSION)){
    session_start();
}

include_once "../classes/dbh.php";
include_once "../classes/pending-complaint.php";

//Instantiate Class
$model = new PendingComplaint();

//get the user id
$residentId = $_SESSION['residentId'];

$search = $_POST['search'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->searchUserPendingComplaints($search, $residentId);
}elseif($_SESSION['accessType'] == "admin"){
    $data = $model->searchAllPendingComplaints($search);
}

$dataCount = count($data);
?>


                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="pending-complaint-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></span>
                                <span class="content__item__desc"><?= $row['complaint_description'] ?></span>
                                <span class="content__item__date"><?= $row['pending_date'] ?></span>
                            <?php 
                                if($row['status'] == "pending"){
                            ?>
                                <span class="content__item__status primary"><?= ucwords($row['status']) ?></span>
                            <?php 
                                }elseif($row['status'] == "rejected"){
                            ?>
                                <span class="content__item__status danger"><?= ucwords($row['status']) ?></span>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                    </a>
                <?php
                    }
                ?>

                <?php
                    if($dataCount == 0){
                ?>
                    <div class="no-data-msg">
                        <p>No data found!</p>
                    </div>
                <?php
                    }
                ?>