<?php
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/pending-complaint-info.php";

//Instantiate Class
$model = new PendingComplaintInfo();

//get the complaint Id
$complaintId = $_GET['id'];


if($_SESSION['accessType'] == 'resident'){
    //get resident id
    $residentId = $_SESSION['residentId'];

    //get data from database
    $data = $model->getUserPendingComplaint($complaintId, $residentId);
    $proofData = $model->getComplaintProofs($complaintId);
    $luponData = $model->getLupons();
    $residentsData = $model->getResidents($residentId);
}elseif($_SESSION['accessType'] == 'admin'){
    //get data from database
    $data = $model->getPendingComplaint($complaintId);
    $proofData = $model->getComplaintProofs($complaintId);
    $luponData = $model->getLupons();
}

if(empty($data)){
    header("location: pending-complaints.php");
}
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Pending Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="pending-complaints.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>
            <?php 
                if($_SESSION['accessType'] == "resident"){
            ?>
                    <form action="includes/delete-complaint.php" method="post">
                        <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                <?php
                    $proofNum = 1;
                    foreach($proofData as $row){
                ?>
                        <input type="hidden" value="<?= $row['image'] ?>" name="proof<?= $proofNum ?>">
                <?php 
                        $proofNum++;
                    }
                ?>
                        <button type="submit" name="deleteBtn" class="content__action">
                            <img src="assets/icons/delete.svg" alt="delete button">
                        </button>
                    </form>
            <?php 
                }
            ?>
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
                            <span class="content__complainant__date"><?= $data['pending_date'] ?></span>
                        </div>
                    </div>

                    <p class="content__comp__lbl">Complaint Status:</p>
                <?php 
                    if($data['status'] == "pending"){
                ?>
                    <p class="content__comp__val primary"><?= ucwords($data['status']) ?></p>
                <?php 
                    }elseif($data['status'] == "rejected"){
                ?>
                    <p class="content__comp__val danger"><?= ucwords($data['status']) ?> - <span class="secondary"><?= $data['message'] ?></span></p>
                <?php 
                    }
                ?>
                    <p class="content__comp__lbl">Name of person being complained about: 
                <?php 
                    if($_SESSION['accessType'] == "resident"){
                ?>
                        <button class="content__comp__edit" onclick="showEditComplaineeModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/>
                            </svg>Edit
                        </button>
                <?php 
                    }
                ?>
                    </p>
                    <p class="content__comp__val"><?= ucwords($data['complainee_first_name']) . " " . ucwords($data['complainee_last_name']) ?></p>

                    <p class="content__comp__lbl">Complaint Description: 
                <?php 
                    if($_SESSION['accessType'] == "resident"){
                ?>
                        <button class="content__comp__edit" onclick="showEditComplaintDescModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/>
                            </svg>Edit
                        </button>
                <?php 
                    }
                ?>
                    </p>
                    <p class="content__comp__val"><?= $data['complaint_description'] ?></p>

                <?php
                    //if(count($proofData) != 0){
                ?>
                    <p class="content__comp__lbl">Proof/Pictures: 
                <?php 
                    if($_SESSION['accessType'] == "resident"){
                ?>
                        <button class="content__comp__edit" onclick="showEditComplaintProofModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/>
                            </svg>Edit
                        </button>
                <?php 
                    }
                ?>
                    </p>
                <?php 
                    //}
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
                    if($_SESSION['accessType'] == "admin" && $data['status'] != "rejected"){
                ?>
                    <div class="content__btn__cont">
                        <button id="approveComplaintBtn" class="primary-btn" onclick="showApproveComplaintModal()">Approve</button>
                        <button id="rejectComplaintBtn" class="danger-btn" onclick="showRejectComplaintModal()">Reject</button>
                    </div>
                <?php 
                    }
                ?>  
                </div>

                <hr class="content__hr">
            </div>
        </section>

        <!-- modal -->
        <div id="approveComplaintModal" class="modal2 modal2--add--comp">
            <form action="includes/approve-complaint.php" id="approveComplaintModalCont" class="modal2__cont" method="post">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Approve Complaint
                    </span>
                    
                    <span id="approveComplaintModalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body">

                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                    <label class="modal2__lbl">
                        Lupon
                    </label>
                    <select name="luponId" id="select-name" placeholder="Please select name..." required>
                        <option value="">Please select name...</option>
                    <?php
                        foreach($luponData as $row){
                    ?>
                        <option value="<?= $row['id'] ?>"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                    <?php
                        }
                    ?>
                    </select>

                    <div class="spacer"></div>

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
                    <button type="button" id="approveComplaintModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="approveBtn">
                </div>
            </form>
        </div>








        <!-- modal -->
        <div id="rejectComplaintModal" class="modal2 modal2--add--comp">
            <form action="includes/reject-complaint.php" id="rejectComplaintModalCont" class="modal2__cont" method="post">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Reject Complaint
                    </span>
                    
                    <span id="rejectComplaintModalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">

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








        


        <!-- modal -->
        <div id="editComplaineeModal" class="modal2 modal2--add--comp" onclick="hideEditComplaineeModal(event)">
            <form action="includes/editComplainee.php" method="post" id="editComplaineeModalCont" class="modal2__cont--small"  >
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Complaint
                    </span>
                    
                    <span id="editComplaineeModalExit" class="modal2__close"  onclick="hideEditComplaineeModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaineeModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                    <label class="modal2__lbl">
                        Name of person being complained about
                    </label>
                    <select name="complaineeId" id="select-name" placeholder="Please select name..." required>
                    <option value="">Please select name...</option>
                <?php
                    foreach($residentsData as $row){
                ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                <?php
                    }
                ?>
                </select>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditComplaineeModal(event)" type="button" id="editComplaineeModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editComplaineeBtn">
                </div>
            </form>
        </div>







                


        <!-- modal -->
        <div id="editComplaintDescModal" class="modal2 modal2--add--comp" onclick="hideEditComplaintDescModal(event)">
            <form action="includes/editComplaintDesc.php" method="post" id="editComplaintDescModalCont" class="modal2__cont--small"  >
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Complaint
                    </span>
                    
                    <span id="editComplaintDescModalExit" class="modal2__close"  onclick="hideEditComplaintDescModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaintDescModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                    <label class="modal2__lbl">
                        Complaint description
                    </label>
                    <textarea class="modal2__input" name="complaintDescription" required></textarea>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditComplaintDescModal(event)" type="button" id="editComplaintDescModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editComplaintDescBtn">
                </div>
            </form>
        </div>










        




                


        <!-- modal -->
        <div id="editComplaintProofModal" class="modal2 modal2--add--comp" onclick="hideEditComplaintProofModal(event)">
            <form action="includes/edit-complaint-proof.php" method="post" id="editComplaintProofModalCont" class="modal2__cont" enctype="multipart/form-data">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Complaint
                    </span>
                    
                    <span id="editComplaintProofModalExit" class="modal2__close"  onclick="hideEditComplaintDescModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaintProofModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">

                    <p class="modal2__lbl">
                        Proof/Pictures (Optional)
                    </p>

                    <label class="home-card__file__lbl" for="pic_input1">
                        <input id="pic_input1" class="home-card__input__file" type="file"
                            name="proof1" onchange="previewImage(this, picPreview1)">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload photo</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="pic_preview1" />
                    </div>

                    <label class="home-card__file__lbl" for="pic_input2">
                        <input id="pic_input2" class="home-card__input__file" type="file"
                            name="proof2" onchange="previewImage(this, picPreview2)">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload photo</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="pic_preview2" />
                    </div>

                    <label class="home-card__file__lbl" for="pic_input3">
                        <input id="pic_input3" class="home-card__input__file" type="file"
                            name="proof3" onchange="previewImage(this, picPreview3)">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload photo</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="pic_preview3" />
                    </div>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditComplaintProofModal(event)" type="button" id="editComplaintProofModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editComplaintProofBtn">
                </div>
            </form>
        </div>










    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>




<script src="js/viewImage.js"></script>
<script src="js/pendingComplaintInfoModals.js"></script>

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>