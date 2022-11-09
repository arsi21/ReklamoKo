<?php
//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

if(!isset($_SESSION)){
    session_start();
}


include_once "classes/dbh.php";
include_once "classes/account-info.php";

//Instantiate Class
$model = new AccountInfo();

$userId = $_SESSION['userId'];

$data = $model->getUser($userId);

if(empty($data)){
    header("location: pending-complaints.php");
}
?>







        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Account Information</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <p class="content__comp__lbl">Profile Picture: 
                        <button class="content__comp__edit" onclick="showEditProfileModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/>
                            </svg>Edit
                        </button>
                    </p>

                    <div class="content__proof__cont">
                    <?php 
                        if($data['profile'] != ""){
                    ?>
                            <img class="content__proof__pic image" src="profile-uploads/<?= $data['profile'] ?>"  alt="resident profile picture">
                    <?php 
                        }else{
                    ?>
                            <img class="content__proof__pic image" src="profile-uploads/default.jpg"  alt="resident profile picture">
                    <?php 
                        }
                    ?>
                    </div>

                    <p class="content__comp__lbl">Mobile Number:</p>
                    <p class="content__comp__val"><?= $data['mobile_number'] ?></p>

                    <p class="content__comp__lbl">Password: 
                        <button class="content__comp__edit" onclick="showEditPasswordModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/>
                            </svg>Edit
                        </button>
                    </p>
                    <p class="content__comp__val">
                    <?php 
                        $passLength = strlen($data['password']);
                        for ($x = 0; $x <= $passLength; $x++) {
                            echo "* ";
                        } 
                    ?>
                    </p>

                </div>

                <hr class="content__hr">
            </div>
        </section>



        <!-- modal -->
        <div id="editPasswordModal" class="modal2 modal2--add--comp" onclick="hideEditPasswordModal(event)">
            <form action="includes/edit-password.php" method="post" id="editPasswordModalCont" class="modal2__cont--small"  >
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Password
                    </span>
                    
                    <span id="editPasswordModalExit" class="modal2__close"  onclick="hideEditPasswordModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editPasswordModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">
                    <label class="modal2__lbl">
                        New Password
                    </label>
                    <input id="password_input" type="password" class="modal2__input" name="password" required></input>

                    <label class="modal2__lbl">
                        Confirm Password
                    </label>
                    <input id="confirm_pass_input" type="password" class="modal2__input" name="confirmPassword" required></input>
                    <div>
                        <input type="checkbox" id="toggle_pwd" name="vehicle1" value="Bike">
                        <label for="toggle_pwd"> show password</label>
                    </div>
                    
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditPasswordModal(event)" type="button" id="editPasswordModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editPasswordBtn">
                </div>
            </form>
        </div>










        




                


        <!-- modal -->
        <div id="editProfileModal" class="modal2 modal2--add--comp" onclick="hideEditProfileModal(event)">
            <form action="includes/edit-profile-picture.php" method="post" id="editProfileModalCont" class="modal2__cont--small" enctype="multipart/form-data">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Profile Picture
                    </span>
                    
                    <span id="editProfileModalExit" class="modal2__close"  onclick="hideEditProfileModal(event)">
                        <img src="assets/icons/exit.svg" alt="" id="editProfileModalExitIcon">
                    </span>
                </div>

                <div class="modal2__body--small">

                    <p class="modal2__lbl">
                        Profile Picture
                    </p>

                    <label class="home-card__file__lbl" for="pic_input1">
                        <input id="pic_input1" class="home-card__input__file" type="file"
                            name="profile" onchange="previewImage(this, picPreview1)">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload photo</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="pic_preview1" />
                    </div>
                </div>

                <div class="modal2__footer">
                    <button onclick="hideEditProfileModal(event)" type="button" id="editProfileModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editProfileBtn">
                </div>
            </form>
        </div>




<?php
if(isset($_GET['message'])){
?>
    
<?php
    if($_GET['message'] == "updatedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
            Updated Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "stmtfailed"){
?>
    <div id="message" class="msg msg-danger" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
        <p>
            Server Error!
        </p>
    </div>
<?php
    }else{
?>
    <div id="message" class="msg msg-danger" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
        <p>
            Please enter correct information!
        </p>
    </div>
<?php
    }
?>
    

<?php
}
?>







    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>




<script src="js/viewImage.js"></script>
<script src="js/account-info-page.js"></script>


    

<!-- include partials -->
<?php include_once 'partials/footer.php';?>