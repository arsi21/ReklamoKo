    <!-- modal -->
    <div id="modal2" class="modal2 modal2--add--comp">
        <form action="" id="modal2-cont" class="modal2__cont">
            <div class="modal2__head">
                <span class="modal2__title">
                    New Complain
                </span>
                
                <span id="modal2-exit" class="modal2__close">
                    <img src="assets/icons/exit.svg" alt="">
                </span>
            </div>

            <div class="modal2__body">
                <label class="modal2__lbl">
                    Name of the complained person 
                </label>
                <input type="text" class="modal2__input" name="compPerson">

                <label class="modal2__lbl">
                    Complain description
                </label>
                <textarea class="modal2__input" name="complainDesc"></textarea>

                <p class="modal2__lbl">
                    Proof/Pictures (Optional)
                </p>

                <div class="modal2__img__prev__cont">
                    <div class="modal2__img__prev">
                        <!-- <img id=img-prev" /> -->
                    </div>
                    <div class="modal2__img__prev">
                        <!-- <img id=img-prev" /> -->
                    </div>
                    <div class="modal2__img__prev">
                        <!-- <img id=img-prev" /> -->
                    </div>
                    <div class="modal2__img__prev">
                        <!-- <img id=img-prev" /> -->
                    </div>
                    <div class="modal2__img__prev">
                        <!-- <img id=img-prev" /> -->
                    </div>
                </div>

                <label class="modal2__upload__lbl" for="upload-pic">
                    <input id="upload-pic" class="modal2__upload__input" type="file"
                    name="complainProof[]" multiple>
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label>
            </div>

            <div class="modal2__footer">
                <button id="modal2-cancel" class="modal2__cancel">Cancel</button>

                <input type="submit" class="modal2__submit" value="Submit" name="submitComp">
            </div>
        </form>
    </div>




    <script src="js/modal.js"></script>

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

        const inboxBtn = document.getElementById('inbox-btn');
        const notifBtn = document.getElementById('notif-btn');
        const accountBtn = document.getElementById('account-btn');
        const modalMessage = document.getElementById('modal-message');
        const modalNotif = document.getElementById('modal-notif');
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
                if (!nav.contains(event.target) && event.target != menuBtn){
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
            if (modalMessage.classList.contains("modal--message--active") || modalNotif.classList.contains("modal--notif--active") || modalAccount.classList.contains("modal--account--active")){
                content.classList.add("content--display--none");
            }else {
                content.classList.remove("content--display--none");
            }
        }

        inboxBtn.addEventListener('click', () => {
            inboxBtn.classList.toggle("header__inbox__cont--active"); //for changing inbox icon color
            notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
            accountBtn.classList.remove("header__profile--active"); //for removing profile icon border
            modalMessage.classList.toggle("modal--message--active"); //for adding modal message
            modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
            modalAccount.classList.remove("modal--account--active"); //for removing modal account

            toggleContent(); //for adding and removing content
        })

        notifBtn.addEventListener('click', () => {
            notifBtn.classList.toggle("header__notif__cont--active"); //for changing notif icon color
            inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
            accountBtn.classList.remove("header__profile--active"); //for removing profile icon border
            modalNotif.classList.toggle("modal--notif--active"); //for adding modal notif
            modalMessage.classList.remove("modal--message--active"); //for removing modal message
            modalAccount.classList.remove("modal--account--active"); //for removing modal account

            toggleContent(); //for adding and removing content
        })

        accountBtn.addEventListener('click', () => {
            accountBtn.classList.toggle("header__profile--active"); //for adding profile icon border
            notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
            inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
            modalAccount.classList.toggle("modal--account--active"); //for adding modal account
            modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
            modalMessage.classList.remove("modal--message--active"); //for removing modal message

            toggleContent(); //for adding and removing content
        })

        document.addEventListener('click', function(event) {
            if (window.innerWidth  > 479){
                if (!inboxBtn.contains(event.target) && !notifBtn.contains(event.target) && !accountBtn.contains(event.target)){
                    modalMessage.classList.remove("modal--message--active"); //for removing modal message
                    modalNotif.classList.remove("modal--notif--active"); //for removing modal notif
                    modalAccount.classList.remove("modal--account--active"); //for removing modal account
                    inboxBtn.classList.remove("header__inbox__cont--active"); //for changing inbox icon color
                    notifBtn.classList.remove("header__notif__cont--active"); //for changing notif icon color
                    accountBtn.classList.remove("header__profile--active"); //for removing profile icon border

                    toggleContent(); //for adding and removing content
                }
            }
        });
        
    </script>
</body>

</html>