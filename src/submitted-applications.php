<?php 
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['accessType'] == "resident"){
    header("location:pending-complaints.php");
}

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

include_once "classes/dbh.php";
include_once "classes/submitted-application.php";

//Instantiate Class
$model = new SubmittedApplication();

$data = $model->getSubmittedApplications();

$dataCount = count($data);
?>




        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Submitted Applications</h2>
            </div>

            <div class="content__body__cont">
                <form class="content__search__cont" action="">
                    <button class="content__search__btn">
                        <img src="assets/icons/search.svg" alt="Search icon">
                    </button>

                    <input class="content__search" id="search_input" type="search" name="search" placeholder="Search a complain">
                </form>

                <div class="content__pages__indicator">
                    <!-- <div class="content__page__num">
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
                    </div> -->
                </div>

                <hr class="content__hr">

                <div class="content__item__list__cont">
                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="submitted-application-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></span>
                                <span class="content__item__desc"><?= $row['house_number'] . " " . ucwords($row['street']) . " " . ucwords($row['barangay']) . " " . ucwords($row['city']) . " " . ucwords($row['province']) ?></span>
                                <span class="content__item__date"><?= $row['date'] ?></span>
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
                        <p>No submitted applications!</p>
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
    if($_GET['message'] == "approvedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Approved Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "rejectedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Rejected Successfully!
        </p>
    </div>
<?php
    }
?>
    

<?php
}
?>





    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>