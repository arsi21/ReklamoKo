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
include_once "classes/lupon.php";

//Instantiate Class
$model = new Lupon();

$data = $model->getAllLupon();
$allResidentsData = $model->getAllResidents();

$dataCount = count($data);
?>




        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Pacification Committee</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__search__cont">
                    <div class="content__search__btn">
                        <img src="assets/icons/search.svg" alt="Search icon">
                    </div>

                    <input class="content__search" id="searchInput" type="search" name="search" placeholder="Search pacification committee name">
                </div>

                <div class="content__pages__indicator">
                    <button class="success-btn" onclick="showEditComplaineeModal()">Add</button>
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
                    <a class="content__item__link" href="lupon-info.php?id=<?= $row['id'] ?>">
                        <div class="content__item__cont">
                            <div class="content__item__info__cont">
                                <span class="content__item__name"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></span>
                                <span class="content__item__desc"><?= $row['house_number'] . " " . ucwords($row['street']) . " " . ucwords($row['barangay']) . " " . ucwords($row['city']) . " " . ucwords($row['province']) ?></span>
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
                        <p>No list of lupon!</p>
                    </div>
                <?php
                    }
                ?>
                </div>
                <hr class="content__hr">
            </div>
        </section>





        
        <!-- modal -->
        <div id="editComplaineeModal" class="modal2 modal2--add--comp" onclick="hideEditComplaineeModal(event)">
            <form action="includes/add-lupon.php" method="post" id="editComplaineeModalCont" class="modal2__cont--small"  >
                <div class="modal2__head">
                    <span class="modal2__title">
                        Add Pacification Committee
                    </span>
                    
                    <span id="editComplaineeModalExit" class="modal2__close"  onclick="hideEditComplaineeModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaineeModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                    <label class="modal2__lbl">
                        Pacification Committee Name
                    </label>
                    <select name="residentId" id="select-name" placeholder="Please select name..." required>
                    <option value="">Please select name...</option>
                <?php
                    foreach($allResidentsData as $row){
                ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                <?php
                    }
                ?>
                </select>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditComplaineeModal(event)" type="button" id="editComplaineeModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="submitBtn">
                </div>
            </form>
        </div>







<?php
if(isset($_GET['message'])){
?>
    
<?php
    if($_GET['message'] == "addedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Added Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "removedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Removed Successfully!
        </p>
    </div>
<?php
    }
?>
    

<?php
}
?>





<script>
const editComplaineeModal = document.getElementById("editComplaineeModal");
const editComplaineeModalCont = document.getElementById("editComplaineeModalCont");
const editComplaineeModalExit = document.getElementById("editComplaineeModalExit");
const editComplaineeModalExitIcon = document.getElementById("editComplaineeModalExitIcon");
const editComplaineeModalCancel = document.getElementById("editComplaineeModalCancel");
const editComplaineeModalBackground = document.getElementById("body-background");

function showEditComplaineeModal() {
    editComplaineeModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaineeModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplaineeModal(event) {
    if (editComplaineeModalExit == event.target || editComplaineeModalExitIcon == event.target || editComplaineeModalCancel == event.target) {
        console.log(event)
        editComplaineeModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaineeModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }

    //console.log(event)
};
</script>

    

<script src="js/searchLupon.js"></script>


<!-- include partials -->
<?php include_once 'partials/footer.php';?>