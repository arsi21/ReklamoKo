<!-- include all needed partials -->
<?php include 'partials/header.php';?>
<?php include 'partials/navigation.php';?>




        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Pending Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="pending-complaints.php">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>

                    <button id="editComplaintBtn" class="content__action">
                        <img src="assets/icons/edit.svg" alt="edit button">
                    </button>

                    <a class="content__action" href="">
                        <img src="assets/icons/delete.svg" alt="delete button">
                    </a>
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <div class="content__complainant__cont">
                        <div class="content__complainant__pic">
                            <img src="assets/residentProfSample.jpg" alt="resident profile picture">
                        </div>

                        <div class="content__complainant__info">
                            <span class="content__complainant__name">Juan Dela Cruz</span>
                            <span class="content__complainant__date">Jan 9, 2022</span>
                        </div>
                    </div>

                    <p class="content__comp__lbl">Name of the complained person:</p>
                    <p class="content__comp__val">Juan Dela Cruz</p>

                    <p class="content__comp__lbl">Complain Description:</p>
                    <p class="content__comp__val">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet</p>

                    <p class="content__comp__lbl">Proof/Pictures:</p>
                    <div class="content__proof__cont">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                    </div>

                    <div class="content__btn__cont">
                        <button id="approveComplaintBtn" class="primary-btn">Approve</button>
                        <button id="rejectComplaintBtn" class="danger-btn">Reject</button>
                    </div>
                </div>

                <hr class="content__hr">
            </div>
        </section>

        <!-- modal -->
        <div id="approveComplaintModal" class="modal2 modal2--add--comp">
            <form action="" id="approveComplaintModalCont" class="modal2__cont">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Approve Complaint
                    </span>
                    
                    <span id="approveComplaintModalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body">
                    <label class="modal2__lbl">
                        Schedule
                    </label>
                    <input type="date" class="modal2__input" name="compPerson">
                </div>

                <div class="modal2__footer">
                    <button type="button" id="approveComplaintModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="approveComplaint">
                </div>
            </form>
        </div>








        <!-- modal -->
        <div id="rejectComplaintModal" class="modal2 modal2--add--comp">
            <form action="" id="rejectComplaintModalCont" class="modal2__cont">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Reject Complaint
                    </span>
                    
                    <span id="rejectComplaintModalExit" class="modal2__close">
                        <img src="assets/icons/exit.svg" alt="">
                    </span>
                </div>

                <div class="modal2__body">
                    <label class="modal2__lbl">
                        Message
                    </label>
                    <textarea class="modal2__input" name="message"></textarea>
                </div>

                <div class="modal2__footer">
                    <button type="button" id="rejectComplaintModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="rejectComplaint">
                </div>
            </form>
        </div>







        <!-- modal -->
        <div id="editComplaintModal" class="modal2 modal2--add--comp">
            <form action="" id="editComplaintModalCont" class="modal2__cont">
                <div class="modal2__head">
                    <span class="modal2__title">
                        Edit Complaint
                    </span>
                    
                    <span id="editComplaintModalExit" class="modal2__close">
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
                    <button type="button" id="editComplaintModalCancel" class="modal2__cancel">Cancel</button>

                    <input type="submit" class="modal2__submit" value="Submit" name="editComplaint">
                </div>
            </form>
        </div>






<script>
const approveComplaintBtn = document.getElementById("approveComplaintBtn");
const approveComplaintModal = document.getElementById("approveComplaintModal");
const approveComplaintModalCont = document.getElementById("approveComplaintModalCont");
const approveComplaintModalExit = document.getElementById("approveComplaintModalExit");
const approveComplaintModalCancel = document.getElementById("approveComplaintModalCancel");
const approveComplaintModalBackground = document.getElementById("body-background");

approveComplaintBtn.addEventListener('click', () => {
    approveComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    approveComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

approveComplaintModalExit.addEventListener('click', () => {
    approveComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    approveComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

approveComplaintModalCancel.addEventListener('click', () => {
    approveComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    approveComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

approveComplaintModal.addEventListener('click', function (event) {
    if (!approveComplaintModalCont.contains(event.target) && approveComplaintBtn != event.target) {
        approveComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        approveComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});





const rejectComplaintBtn = document.getElementById("rejectComplaintBtn");
const rejectComplaintModal = document.getElementById("rejectComplaintModal");
const rejectComplaintModalCont = document.getElementById("rejectComplaintModalCont");
const rejectComplaintModalExit = document.getElementById("rejectComplaintModalExit");
const rejectComplaintModalCancel = document.getElementById("rejectComplaintModalCancel");
const rejectComplaintModalBackground = document.getElementById("body-background");

rejectComplaintBtn.addEventListener('click', () => {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

rejectComplaintModalExit.addEventListener('click', () => {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

rejectComplaintModalCancel.addEventListener('click', () => {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

rejectComplaintModal.addEventListener('click', function (event) {
    if (!rejectComplaintModalCont.contains(event.target) && rejectComplaintBtn != event.target) {
        rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});





const editComplaintBtn = document.getElementById("editComplaintBtn");
const editComplaintModal = document.getElementById("editComplaintModal");
const editComplaintModalCont = document.getElementById("editComplaintModalCont");
const editComplaintModalExit = document.getElementById("editComplaintModalExit");
const editComplaintModalCancel = document.getElementById("editComplaintModalCancel");
const editComplaintModalBackground = document.getElementById("body-background");

editComplaintBtn.addEventListener('click', () => {
    editComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

editComplaintModalExit.addEventListener('click', () => {
    editComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

editComplaintModalCancel.addEventListener('click', () => {
    editComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

editComplaintModal.addEventListener('click', function (event) {
    if (!editComplaintModalCont.contains(event.target) && editComplaintBtn != event.target) {
        editComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        editComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});
</script>

    

<!-- include partials -->
<?php include 'partials/footer.php';?>