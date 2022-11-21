<?php
if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/residents-info.php";

//Instantiate Class
$model = new ResidentsInfo();

//get the Id
$id = $_GET['id'];

//get data from database
$data = $model->getResident($id);


if(empty($data)){
    header("location:residents.php");
}

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Residents</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="resident-accounts.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>
                    <button class="success-btn" onclick="showEditComplaineeModal()">Generate Report</button>
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
                </div>

                <hr class="content__hr">
            </div>
        </section>

    
    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>



    <!-- modal -->
    <div id="editComplaineeModal" class="modal2 modal2--add--comp" onclick="hideEditComplaineeModal(event)">
            <form action="includes/generate-resident-report.php" method="post" id="editComplaineeModalCont" class="modal2__cont--small"  >
                <div class="modal2__head">
                    <span class="modal2__title">
                        Generate Report
                    </span>
                    
                    <span id="editComplaineeModalExit" class="modal2__close"  onclick="hideEditComplaineeModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaineeModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $data['id'] ?>" name="id">
                    <input type="hidden" value="<?= ucwords($data['first_name']). " " . ucwords($data['last_name']) ?>" name="name">
                    <label class="modal2__lbl">
                        Report For
                    </label>
                    <select name="reportType" id="select-name" placeholder="Please select name..." required>
                        <option value="">Please select name...</option>
                        <option value="1">Complaints Reported</option>
                        <option value="2">Complaints Against With</option>
                    </select>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditComplaineeModal(event)" type="button" id="editComplaineeModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="submitBtn">
                </div>
            </form>
        </div>


<script src="js/viewImage.js"></script>
<script src="js/residents-page.js"></script>

<!-- include partials -->
<?php include_once 'partials/footer.php';?>