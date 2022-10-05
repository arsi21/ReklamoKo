<?php
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/lupon-info.php";

//Instantiate Class
$model = new LuponInfo();

//get the application Id
$luponId = $_GET['id'];

//get data from database
$data = $model->getLupon($luponId);


if(empty($data)){
    header("location:lupon.php");
}
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Lupon</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="lupon.php">
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

                    <div class="content__btn__cont">
                        <form action="includes/remove-lupon.php" method="post">
                            <input type="hidden" value="<?= $data['id'] ?>" name="luponId">
                            <button name="removeBtn" type="submit" id="rejectComplaintBtn" class="danger-btn">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="content__hr">
            </div>
        </section>

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>