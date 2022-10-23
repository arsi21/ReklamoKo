<?php
if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/submitted-application-info.php";

//Instantiate Class
$model = new SubmittedApplicationInfo();

//get the application Id
$applicationId = $_GET['id'];

//get data from database
$data = $model->getSubmittedApplication($applicationId);


if(empty($data)){
    header("location: submitted-applications.php");
}

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Submitted Applications</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="submitted-applications.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <p class="content__comp__lbl">First Name:</p>
                    <p class="content__comp__val"><?= ucwords($data['first_name']) ?></p>

                    <p class="content__comp__lbl">Middle Name:</p>
                    <p class="content__comp__val"><?= ucwords($data['middle_name']) ?></p>

                    <p class="content__comp__lbl">Last Name:</p>
                    <p class="content__comp__val"><?= ucwords($data['last_name']) ?></p>

                    <p class="content__comp__lbl">Suffix:</p>
                    <p class="content__comp__val"><?= ucwords($data['suffix']) ?></p>

                    <p class="content__comp__lbl">Address:</p>
                    <p class="content__comp__val"><?= $data['house_number'] . " " . ucwords($data['street']) . " " . ucwords($data['barangay']) . " " . ucwords($data['city']) . " " . ucwords($data['province']) ?></p>

                    <p class="content__comp__lbl">Front ID:</p>
                    <div class="content__proof__cont">
                        <img class="content__proof__pic image" src="id-uploads/<?= $data['front_id'] ?>" alt="Front id"> 
                    </div>

                    <p class="content__comp__lbl">Back ID:</p>
                    <div class="content__proof__cont">
                        <img class="content__proof__pic image" src="id-uploads/<?= $data['back_id'] ?>" alt="Back id"> 
                    </div>

                    <p class="content__comp__lbl">Portrait Photo:</p>
                    <div class="content__proof__cont">
                        <img class="content__proof__pic image" src="portrait-uploads/<?= $data['portrait_photo'] ?>" alt="Portrait photo"> 
                    </div>

                    <div class="content__btn__cont">
                        <form action="includes/approve-application.php" method="post">
                            <input type="hidden" value="<?= $data['id'] ?>" name="applicationId">
                            <input type="hidden" value="<?= $data['user_id'] ?>" name="userId">
                            <input type="hidden" value="<?= $data['mobile_number'] ?>" name="number">
                            <button type="submit" id="approveComplaintBtn" class="primary-btn" name="approveBtn">Approve</button>
                        </form>
                        <button id="rejectComplaintBtn" class="danger-btn" onclick="showRejectComplaintModal()">Reject</button>
                    </div>
                </div>

                <hr class="content__hr">
            </div>
        </section>

        


        <!-- modal -->
        <div id="rejectComplaintModal" class="modal2 modal2--add--comp">
            <form action="includes/reject-application.php" method="post" id="rejectComplaintModalCont" class="modal2__cont--small">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Reject Application
                    </span>
                    
                    <span id="rejectComplaintModalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $data['id'] ?>" name="applicationId">
                    <input type="hidden" value="<?= $data['user_id'] ?>" name="userId">
                    <input type="hidden" value="<?= $data['mobile_number'] ?>" name="number">

                    <label class="modal2__lbl">
                        Message
                    </label>
                    <textarea class="modal2__input" name="message"></textarea>
                </div>

                <div class="modal2__footer">
                    <button type="button" id="rejectComplaintModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="rejectBtn">
                </div>
            </form>
        </div>






    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>




<script src="js/viewImage.js"></script>

<script>
const rejectComplaintModal = document.getElementById("rejectComplaintModal");
const rejectComplaintModalCont = document.getElementById("rejectComplaintModalCont");
const rejectComplaintModalExit = document.getElementById("rejectComplaintModalExit");
const rejectComplaintModalCancel = document.getElementById("rejectComplaintModalCancel");
const rejectComplaintModalBackground = document.getElementById("body-background");

function showRejectComplaintModal() {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};


rejectComplaintModalExit.addEventListener('click', () => {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

rejectComplaintModalCancel.addEventListener('click', () => {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

rejectComplaintModal.addEventListener('click', function (event) {
    if (!rejectComplaintModalCont.contains(event.target) && rejectComplaintBtn != event.target) {
        rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});
</script>

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>