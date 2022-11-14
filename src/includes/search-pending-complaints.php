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
$userId = $_SESSION['userId'];

$search = $_POST['search'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->searchUserPendingComplaints($search, $userId);
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
                        <p>No pending complaints!</p>
                    </div>
                <?php
                    }
                ?>