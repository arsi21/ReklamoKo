<?php
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}

include_once "classes/dbh.php";
include_once "classes/pending-complaint.php";

//Instantiate Class
$model = new PendingComplaint();

//get the user id
$userId = $_SESSION['userId'];
$residentId = $_SESSION['residentId'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->getUserPendingComplaints($residentId);
}elseif($_SESSION['accessType'] == "admin"){
    $data = $model->getAllPendingComplaints();
}

$dataCount = count($data);
?>






        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Pending Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__search__cont">
                    <div class="content__search__btn">
                        <img src="assets/icons/search.svg" alt="Search icon">
                    </div>

                    <input class="content__search" id="searchInput" type="search" name="search" placeholder="Search complainant name or complaint type">
                </div>

                <!-- <div class="content__pages__indicator">
                    <div class="content__page__num">
                        <span>1</span><span>-</span><span>50</span><span> of </span><span>100</span>
                    </div>

                    <div class="content__page__action">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10.583" height="16.934" viewBox="0 0 10.583 16.934">
                            <path id="arrow" d="M5,2.117,7.157,0l8.427,8.467L7.157,16.934,5,14.817l6.35-6.35Z" transform="translate(15.583 16.934) rotate(180)" fill="#979797"/>
                            </svg>
                        </button>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10.583" height="16.934" viewBox="0 0 10.583 16.934">
                            <path id="arrow" d="M5,2.117,7.157,0l8.427,8.467L7.157,16.934,5,14.817l6.35-6.35Z" transform="translate(-5)" fill="#403f3f"/>
                            </svg>
                        </button>
                    </div>
                </div> -->

                <hr class="content__hr">

                <div id="dataCont" class="content__item__list__cont">
                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="pending-complaint-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                        <?php 
                            if($_SESSION['accessType'] == "admin"){
                        ?>
                            <div>
                                <span class="content__item__name">
                                    <?= ucwords($row['complainant']) ?>
                                </span>
                            <?php 
                                if($row['complainant_count'] == 2){
                            ?>
                                <span class="content__item__name">
                                    <?= "& " . $row['complainant_count'] - 1 . " other" ?>
                                </span>
                            <?php 
                                }elseif($row['complainant_count'] > 2){
                            ?>
                                <span class="content__item__name">
                                    <?= "& " . $row['complainant_count'] - 1 . " others" ?>
                                </span>
                            <?php 
                                }
                            ?>

                            </div>
                        <?php 
                            }
                        ?>
                                <span class="content__item__desc"><?= $row['type'] ?></span>
                                <span class="content__item__date"><?= $row['pending_date'] ?></span>
                            <?php 
                                if($row['status'] == "pending"){
                            ?>
                                <span class="content__item__status primary"><?= ucwords($row['status']) ?></span>
                            <?php 
                                }elseif($row['status'] == "rejected"){
                            ?>
                                <span class="content__item__status danger"><?= ucwords($row['status']) ?></span>
                            <?php
                                }
                            ?>
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
                        <p>No pending complaints!</p>
                    </div>
                <?php
                    }
                ?>
                </div>
                <hr class="content__hr">
            </div>
        </section>









<?php
if(isset($_GET['message'])){
?>
    
<?php
    if($_GET['message'] == "deletedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Deleted Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "approvedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Approved Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "addedMessageSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Added Message Successfully!
        </p>
    </div>
<?php
    }
?>
    

<?php
}
?>



<script src="js/searchPendingComplaints.js"></script>

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>