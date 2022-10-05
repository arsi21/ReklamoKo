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
                <h2 class="content__title">Lupon</h2>
            </div>

            <div class="content__body__cont">
                <form class="content__search__cont" action="">
                    <button class="content__search__btn">
                        <img src="assets/icons/search.svg" alt="Search icon">
                    </button>

                    <input class="content__search" id="search_input" type="search" name="search" placeholder="Search a complain">
                </form>

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

                <div class="content__item__list__cont">
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
                        Add Lupon
                    </span>
                    
                    <span id="editComplaineeModalExit" class="modal2__close"  onclick="hideEditComplaineeModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editComplaineeModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <input type="hidden" value="<?= $complaintId ?>" name="complaintId">
                    <label class="modal2__lbl">
                        Lupon Name
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

    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>