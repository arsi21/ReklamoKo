<?php 
if(!isset($_POST['search'])){
    header("location: ../logs.php");
}

if(!isset($_SESSION)){
    session_start();
}

    
include_once "../classes/dbh.php";
include_once "../classes/log.php";

//Instantiate Class
$model = new Log();

$search = $_POST['search'];

//get data from database
$data = $model->searchLogs($search);


$dataCount = count($data);
?>


                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['name']) ?></span>
                                <span class="content__item__desc"><?= $row['action_made'] ?></span>
                                <span class="content__item__date"><?= date("M-d-Y g:i a", strtotime($row['date_time'])) ?></span>
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
                        <p>No logs!</p>
                    </div>
                <?php
                    }
                ?>