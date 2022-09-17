<?php

if(!isset($_SESSION)){
    session_start();
}


include "classes/dbh.php";
include "classes/ongoing-complaint.php";

//Instantiate Class
$ongoingComplaint = new OngoingComplaint();

//get the complaint Id
$complaintId = $_GET['id'];

if($_SESSION['accessType'] == 'resident'){
    //get resident id
    $residentId = $_SESSION['residentId'];

    //get data from database
    $data = $ongoingComplaint->getUserOngoingComplaint($complaintId, $residentId);
    $proofData = $ongoingComplaint->getComplaintProofs($complaintId);
    $meetingData = $ongoingComplaint->getMeetingSchedules($complaintId);
}elseif($_SESSION['accessType'] == 'admin'){
    //get data from database
    $data = $ongoingComplaint->getAllOngoingComplaint($complaintId);
    $proofData = $ongoingComplaint->getComplaintProofs($complaintId);
    $meetingData = $ongoingComplaint->getMeetingSchedules($complaintId);
}

if(empty($data)){
    header("location: ongoing-complaints.php");
}
?>


<!-- include all needed partials -->
<?php include 'partials/header.php';?>
<?php include 'partials/navigation.php';?>





        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Ongoing Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="ongoing-complaints.php">
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
                            <span class="content__complainant__date"><?= $data['ongoing_date'] ?></span>
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

                <?php
                    if($_SESSION['accessType'] == "admin"){
                ?>
                    <div class="content__btn__cont">
                <?php
                        if(count($meetingData) != 3){
                ?>
                        <button id="nextMeetingBtn" class="success-btn" onclick="showNextMeetingModal()">Next Meeting</button>
                <?php 
                        }
                ?> 
                        <form action="includes/add-solved-complaint.php" method="post">
                            <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                            <button type="submit" class="primary-btn" name="solvedBtn">Solved</button>
                        </form>

                        <form action="includes/add-transferred-complaint.php" method="post">
                            <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                            <button type="submit" class="danger-btn" name="transferredBtn">Transferred</button>
                        </form>
                    </div>
                <?php 
                    }
                ?>  
                </div>

                <hr class="content__hr">
            </div>
        </section>





        <!-- modal -->
        <div id="modal" class="modal2 modal2--add--comp">
            <form action="includes/add-meeting-schedule.php" id="modalCont" class="modal2__cont" method="post">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Next Meeting Schedule
                    </span>
                    
                    <span id="modalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body">

                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">

                    <label class="modal2__lbl">
                        Schedule Date
                    </label>
                    <input type="date" class="modal2__input" name="scheduleDate" required>

                    <label class="modal2__lbl">
                        Schedule Time
                    </label>
                    <input type="time" class="modal2__input" name="scheduleTime" required>
                </div>

                <div class="modal2__footer">
                    <button type="button" id="modalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="nextMeetingBtn">
                </div>
            </form>
        </div>










<script>
const modal = document.getElementById("modal");
const modalCont = document.getElementById("modalCont");
const modalExit = document.getElementById("modalExit");
const modalCancel = document.getElementById("modalCancel");
const modalBackground = document.getElementById("body-background");

function showNextMeetingModal() {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
}


modalExit.addEventListener('click', () => {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modalCancel.addEventListener('click', () => {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modal.addEventListener('click', function (event) {
    if (!modalCont.contains(event.target) && nextMeetingBtn != event.target) {
        modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});
</script>

    

<!-- include partials -->
<?php include 'partials/footer.php';?>