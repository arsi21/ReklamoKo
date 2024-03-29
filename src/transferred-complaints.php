<?php 
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}

    
include_once "classes/dbh.php";
include_once "classes/transferred-complaint.php";

//Instantiate Class
$model = new TransferredComplaint();

//get the user id
$residentId = $_SESSION['residentId'];

//get data from database
if($_SESSION['accessType'] == "resident"){
    $data = $model->getUserTransferredComplaints($residentId);
}elseif($_SESSION['accessType'] == "admin"){
    $data = $model->getAllTransferredComplaints();
}

$dataCount = count($data);
?>






        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Transferred Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__search__cont">
                    <div class="content__search__btn">
                        <img src="assets/icons/search.svg" alt="Search icon">
                    </div>

                    <input class="content__search" id="searchInput" type="search" name="search" placeholder="Search complainee name">
                </div>

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

                <div id="dataCont" class="content__item__list__cont">
                <?php
                    foreach($data as $row){
                ?>
                    <a class="content__item__link" href="transferred-complaint-info.php?id=<?= $row['id'] ?>">
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
                                <span class="content__item__date"><?= $row['transferred_date'] ?></span>
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
                        <p>No transferred complaints!</p>
                    </div>
                <?php
                    }
                ?>
                </div>
                <hr class="content__hr">
            </div>
        </section>
    </div>




<script src="js/searchTransferredComplaints.js"></script>

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>