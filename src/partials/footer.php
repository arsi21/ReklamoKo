    <!-- modal -->
    <div id="modal2" class="modal2 modal2--add--comp">
        <form action="includes/add-complaint.php" method="post" enctype="multipart/form-data" id="modal2-cont" class="modal2__cont">
            <div class="modal2__head">
                <span class="modal2__title">
                    New Complaint
                </span>
                
                <span id="modal2-exit" class="modal2__close">
                    <img src="assets/icons/exit.svg" alt="">
                </span>
            </div>

            <div class="modal2__body">
                <label class="modal2__lbl">
                    Name of person being complained about
                </label>
                <select name="complainee" id="select-name" placeholder="Please select name..." required>
                    <option value="">Please select name...</option>
                <?php
                    foreach($residentsData as $row){
                ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                <?php
                    }
                ?>
                </select>

                <div class="spacer"></div>

                <!-- <label class="modal2__lbl">
                    Name of person being complained about
                </label>
                <input type="text" class="modal2__input" name="complainee"> -->

                <label class="modal2__lbl">
                    Complaint description
                </label>
                <textarea class="modal2__input" name="complaintDescription" required></textarea>

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

                <!-- <div class="modal2__img__prev__cont">
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                </div> -->

                <!-- <label class="modal2__upload__lbl" for="upload-pic">
                    <input id="upload-pic" class="modal2__upload__input" type="file"
                    name="complainProof[]" multiple>
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label> -->
            </div>

            <div class="modal2__footer">
                <button id="modal2-cancel" class="modal2__cancel">Cancel</button>

                <input type="submit" class="modal2__submit" value="Submit" name="submitBtn">
            </div>
        </form>
    </div>



<?php
if(isset($_GET['message'])){
?>
    
<?php
    if($_GET['message'] == "complaintSubmittedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
           Complaint Submitted Successfully!
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
    }
?>
    

<?php
}
?>








    <script src="js/modal.js"></script>
    <script src="js/showSelectedPic.js"></script>
    <script src="js/popUpMessage.js"></script>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const nav = document.getElementById('nav');
        const bodyWrapper = document.getElementById('body-wrapper');
        const body = document.getElementById('body-background');
        const content = document.getElementById('content');

        const navDashboard = document.getElementById('nav-dashboard');
        const navPending = document.getElementById('nav-pending');
        const navOngoing = document.getElementById('nav-ongoing');
        const navTransferred = document.getElementById('nav-transferred');
        const navSolved = document.getElementById('nav-solved');

        // const inboxBtn = document.getElementById('inbox-btn');
        // const notifBtn = document.getElementById('notif-btn');
        const accountBtn = document.getElementById('account-btn');
        // const modalMessage = document.getElementById('modal-message');
        // const modalNotif = document.getElementById('modal-notif');
        const modalAccount = document.getElementById('modal-account');





///////////////////////for showing menu
        menuBtn.addEventListener('click', () => {
            if (window.innerWidth  >= 960){
                //for minimizing and maximazing the menu in big screen
                nav.classList.toggle("nav--desk--close");
                content.classList.toggle("content--desk--menu--close");
                bodyWrapper.classList.toggle("body-wrapper--desk--menu--close");
            }else {
                //for closing and opening the menu in smaller screen
                nav.classList.toggle("nav--mobile--open");
            }
        })


        //for closing and opening the menu in smaller screen when they click outside the
        document.addEventListener('click', function(event) {
            if(window.innerWidth  < 960){
                if (!nav.contains(event.target) && event.target != menuBtn || event.target == addComplainBtn){
                    nav.classList.remove("nav--mobile--open");
             }
            }
        });








// ////////////for redirecting to other page using navigation
//         //function for removing all classList "nav--active"
//         function navRemoveClass() {
//             navDashboard.classList.remove("nav--active");
//             navPending.classList.remove("nav--active");
//             navOngoing.classList.remove("nav--active");
//             navTransferred.classList.remove("nav--active");
//             navSolved.classList.remove("nav--active");
//         }

//         console.log();

//         navDashboard.addEventListener('click', () => {
//             navRemoveClass();//for removing all classlist "nav--active"

//             navDashboard.classList.add("nav--active");
//         })

//         navPending.addEventListener('click', () => {
//             navRemoveClass();//for removing all classlist "nav--active"

//             navPending.classList.add("nav--active");
//         })

//         navOngoing.addEventListener('click', () => {
//             navRemoveClass();//for removing all classlist "nav--active"

//             navOngoing.classList.add("nav--active");
//         })

//         navTransferred.addEventListener('click', () => {
//             navRemoveClass();//for removing all classlist "nav--active"

//             navTransferred.classList.add("nav--active");
//         })

//         navSolved.addEventListener('click', () => {
//             navRemoveClass();//for removing all classlist "nav--active"

//             navSolved.classList.add("nav--active");
//         })









//////////////for showing message, notification, and profile modal

        //function for adding or removing content
        function toggleContent() {
            if (modalAccount.classList.contains("modal--account--active")){
                content.classList.add("content--display--none");
            }else {
                content.classList.remove("content--display--none");
            }
        }

        // inboxBtn.addEventListener('click', () => {
        //     inboxBtn.classList.toggle("header__inbox__cont--active"); //for changing inbox icon color
        //     notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
        //     accountBtn.classList.remove("header__profile--active"); //for removing profile icon border
        //     modalMessage.classList.toggle("modal--message--active"); //for adding modal message
        //     modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
        //     modalAccount.classList.remove("modal--account--active"); //for removing modal account

        //     toggleContent(); //for adding and removing content
        // })

        // notifBtn.addEventListener('click', () => {
        //     notifBtn.classList.toggle("header__notif__cont--active"); //for changing notif icon color
        //     inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
        //     accountBtn.classList.remove("header__profile--active"); //for removing profile icon border
        //     modalNotif.classList.toggle("modal--notif--active"); //for adding modal notif
        //     modalMessage.classList.remove("modal--message--active"); //for removing modal message
        //     modalAccount.classList.remove("modal--account--active"); //for removing modal account

        //     toggleContent(); //for adding and removing content
        // })

        accountBtn.addEventListener('click', () => {
            accountBtn.classList.toggle("header__profile--active"); //for adding profile icon border
            // notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
            // inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
            modalAccount.classList.toggle("modal--account--active"); //for adding modal account
            // modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
            // modalMessage.classList.remove("modal--message--active"); //for removing modal message

            toggleContent(); //for adding and removing content
        })

        document.addEventListener('click', function(event) {
            if (window.innerWidth  > 479){
                if (!accountBtn.contains(event.target)){
                    // modalMessage.classList.remove("modal--message--active"); //for removing modal message
                    // modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
                    modalAccount.classList.remove("modal--account--active"); //for removing modal account
                    // inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
                    // notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
                    accountBtn.classList.remove("header__profile--active"); //for removing profile icon border

                    toggleContent(); //for adding and removing content
                }
            }
        });
        

        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
</body>

</html>