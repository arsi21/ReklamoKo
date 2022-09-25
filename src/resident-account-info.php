<?php
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/resident-account-info.php";

//Instantiate Class
$model = new ResidentAccountInfo();

//get the application Id
$userId = $_GET['id'];

//get data from database
$data = $model->getResidentAccount($userId);


if(empty($data)){
    header("location:resident-accounts.php");
}
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Resident Accounts</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="resident-accounts.php">
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