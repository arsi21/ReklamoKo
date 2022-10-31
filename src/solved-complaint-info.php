<?php
if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/solved-complaint-info.php";

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

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Solved Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="solved-complaints.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <div class="content__complainant__cont">
                        <div class="content__complainant__pic">
                            <img src="profile-uploads/<?= $data['profile'] ?>" alt="resident profile picture">
                        </div>

                        <div class="content__complainant__info">
                            <span class="content__complainant__name"><?= ucwords($data['complainant_first_name']) . " " . ucwords($data['complainant_last_name']) ?></span>
                            <span class="content__complainant__date"><?= $data['solved_date'] ?></span>
                        </div>
                    </div>

                    <p class="content__comp__lbl">Name of person being complained about:</p>
                    <p class="content__comp__val"><?= ucwords($data['complainee_first_name']) . " " . ucwords($data['complainee_last_name']) ?></p>

                    <p class="content__comp__lbl">Complaint Type:</p>
                    <p class="content__comp__val"><?= $data['type'] ?></p>

                    <p class="content__comp__lbl">Complaint Description:</p>
                    <p class="content__comp__val"><?= $data['complaint_description'] ?></p>

                    <p class="content__comp__lbl">Pacification Committee:</p>
                    <p class="content__comp__val"><?= ucwords($data['lupon_first_name']) . " " . ucwords($data['lupon_last_name']) ?></p>

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
                        <img class="content__proof__pic image" src="proof-uploads/<?= $row['image'] ?>" alt="Proof picture">
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


    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>

    
<script src="js/viewImage.js"></script>
<!-- include partials -->
<?php include_once 'partials/footer.php';?>