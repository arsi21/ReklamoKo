<?php

if(!isset($_SESSION)){
    session_start();
}


include "classes/dbh.php";
include "classes/solved-complaint-info.php";

//Instantiate Class
$model = new SolvedComplaintInfo();

//get the complaint Id
$complaintId = $_GET['id'];

if($_SESSION['accessType'] == 'resident'){
    //get resident id
    $residentId = $_SESSION['residentId'];

    //get data from database
    $data = $model->getUserSolvedComplaint($complaintId, $residentId);
    $proofData = $model->getComplaintProofs($complaintId);
    $meetingData = $model->getMeetingSchedules($complaintId);
}elseif($_SESSION['accessType'] == 'admin'){
    //get data from database
    $data = $model->getAllSolvedComplaint($complaintId);
    $proofData = $model->getComplaintProofs($complaintId);
    $meetingData = $model->getMeetingSchedules($complaintId);
}

if(empty($data)){
    header("location: solved-complaints.php");
}
?>


<!-- include all needed partials -->
<?php include 'partials/header.php';?>
<?php include 'partials/navigation.php';?>





        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Solved Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="transferred-complaints.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <div class="content__complainant__cont">
                        <div class="content__complainant__pic">
                    <?php 
                        if($_SESSION['profile'] != ""){
                    ?>
                            <img src="profile-uploads/<?= $_SESSION['profile'] ?>" alt="resident profile picture">
                    <?php 
                        }else{
                    ?>
                            <img src="profile-uploads/default.jpg" alt="resident profile picture">
                    <?php 
                        }
                    ?>
                        </div>

                        <div class="content__complainant__info">
                            <span class="content__complainant__name"><?= ucwords($data['complainant_first_name']) . " " . ucwords($data['complainant_last_name']) ?></span>
                            <span class="content__complainant__date"><?= $data['solved_date'] ?></span>
                        </div>
                    </div>

                    <p class="content__comp__lbl">Name of the complained person:</p>
                    <p class="content__comp__val"><?= ucwords($data['complainee_first_name']) . " " . ucwords($data['complainee_last_name']) ?></p>

                    <p class="content__comp__lbl">Complain Description:</p>
                    <p class="content__comp__val"><?= $data['complaint_description'] ?></p>

                <?php
                    if(count($proofData) != 0){
                ?>
                    <p class="content__comp__lbl">Proof/Pictures:</p>
                <?php 
                    }
                ?> 
                    <div class="content__proof__cont">
                <?php
                    foreach($proofData as $row){
                ?>
                        <img class="content__proof__pic" src="proof-uploads/<?= $row['image'] ?>" alt="Proof picture">
                <?php 
                    }
                ?>    
                    </div>

                <?php
                    $meetingNum = 1;
                    foreach($meetingData as $row){
                ?>
                    <p class="content__comp__lbl">Meeting Schedule <?= $meetingNum ?>:</p>
                    <p class="content__comp__val"><?= date("m-d-Y", strtotime($row['date'])) . " " . date("g:i a", strtotime($row['time'])) ?></p>
                <?php 
                        $meetingNum++;
                    }
                ?> 
                </div>

                <hr class="content__hr">
            </div>
        </section>




    

<!-- include partials -->
<?php include 'partials/footer.php';?>