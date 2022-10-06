<?php 
if(!isset($_POST['search'])){
    header("location: ../transferred-complaints.php");
}

if(!isset($_SESSION)){
    session_start();
}

    
include_once "../classes/dbh.php";
include_once "../classes/transferred-complaint.php";

//Instantiate Class
$model = new TransferredComplaint();

//get the user id
$residentId = $_SESSION['residentId'];

$search = $_POST['search'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->searchUserTransferredComplaints($search, $residentId);
}elseif($_SESSION['accessType'] == "admin"){
    $data = $model->searchAllTransferredComplaints($search);
}

$dataCount = count($data);
?>



                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="transferred-complaint-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></span>
                                <span class="content__item__desc"><?= $row['complaint_description'] ?></span>
                                <span class="content__item__date"><?= $row['transferred_date'] ?></span>
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