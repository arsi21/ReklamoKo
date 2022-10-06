<?php 
if(!isset($_POST['search'])){
    header("location: ../resident-accounts.php");
}

if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['accessType'] == "resident"){
    header("location: ../pending-complaints.php");
}

include_once "../classes/dbh.php";
include_once "../classes/resident-account.php";

//Instantiate Class
$model = new ResidentAccount();

$search = $_POST['search'];

$data = $model->searchResidentAccounts($search);

$dataCount = count($data);
?>


                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="resident-account-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></span>
                                <span class="content__item__desc"><?= $row['house_number'] . " " . ucwords($row['street']) . " " . ucwords($row['barangay']) . " " . ucwords($row['city']) . " " . ucwords($row['province']) ?></span>
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
                        <p>No resident accounts!</p>
                    </div>
                <?php
                    }
                ?>