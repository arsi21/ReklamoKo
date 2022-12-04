<?php 
if(!isset($_POST['search'])){
    header("location: ../ongoing-complaints.php");
}

if(!isset($_SESSION)){
    session_start();
}

include_once "../classes/dbh.php";
include_once "../classes/ongoing-complaint.php";

//Instantiate Class
$model = new OngoingComplaint();

//get the user id
$residentId = $_SESSION['residentId'];

$search = $_POST['search'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->searchUserOngoingComplaints($search, $residentId);
}elseif($_SESSION['accessType'] == "admin"){
    $data = $model->searchAllOngoingComplaints($search);
}

$dataCount = count($data);

?>
                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="ongoing-complaint-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                        <?php 
                            if($_SESSION['accessType'] == "admin"){
                        ?>
                            <div>
                                <span class="content__item__name">
                                    <?= ucwords($row['complainant']) ?>
                                </span>
                            <?php 
                                if($row['complainant_count'] == 2){
                            ?>
                                <span class="content__item__name">
                                    <?= "& " . $row['complainant_count'] - 1 . " other" ?>
                                </span>
                            <?php 
                                }elseif($row['complainant_count'] > 2){
                            ?>
                                <span class="content__item__name">
                                    <?= "& " . $row['complainant_count'] - 1 . " others" ?>
                                </span>
                            <?php 
                                }
                            ?>

                            </div>
                        <?php 
                            }
                        ?>
                                <span class="content__item__desc"><?= $row['type'] ?></span>
                                <span class="content__item__date"><?= $row['ongoing_date'] ?></span>
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
                        <p>No ongoing complaints!</p>
                    </div>
                <?php
                    }
                ?>
