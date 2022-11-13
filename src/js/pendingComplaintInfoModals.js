//for modal
const approveComplaintModal = document.getElementById("approveComplaintModal");
const approveComplaintModalCont = document.getElementById("approveComplaintModalCont");
const approveComplaintModalExit = document.getElementById("approveComplaintModalExit");
const approveComplaintModalCancel = document.getElementById("approveComplaintModalCancel");
const approveComplaintModalBackground = document.getElementById("body-background");

function showApproveComplaintModal() {
    approveComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    approveComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
}


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





const rejectComplaintModal = document.getElementById("rejectComplaintModal");
const rejectComplaintModalCont = document.getElementById("rejectComplaintModalCont");
const rejectComplaintModalExit = document.getElementById("rejectComplaintModalExit");
const rejectComplaintModalCancel = document.getElementById("rejectComplaintModalCancel");
const rejectComplaintModalBackground = document.getElementById("body-background");

function showRejectComplaintModal() {
    rejectComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    rejectComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};


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






const editComplaintModal = document.getElementById("editComplaintModal");
const editComplaintModalCont = document.getElementById("editComplaintModalCont");
const editComplaintModalExit = document.getElementById("editComplaintModalExit");
const editComplaintModalExitIcon = document.getElementById("editComplaintModalExitIcon");
const editComplaintModalCancel = document.getElementById("editComplaintModalCancel");
const editComplaintModalBackground = document.getElementById("body-background");

function showEditComplaintModal() {
    editComplaintModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplaintModal(event) {
    if (event.target == editComplaintModal || editComplaintModalExit == event.target || editComplaintModalExitIcon == event.target || editComplaintModalCancel == event.target) {
        editComplaintModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaintModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }
};






const editComplainantModal = document.getElementById("editComplainantModal");
const editComplainantModalCont = document.getElementById("editComplainantModalCont");
const editComplainantModalExit = document.getElementById("editComplainantModalExit");
const editComplainantModalExitIcon = document.getElementById("editComplainantModalExitIcon");
const editComplainantModalCancel = document.getElementById("editComplainantModalCancel");
const editComplainantModalBackground = document.getElementById("body-background");

function showEditComplainantModal() {
    editComplainantModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplainantModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplainantModal(event) {
    if (editComplainantModalExit == event.target || editComplainantModalExitIcon == event.target || editComplainantModalCancel == event.target) {
        console.log(event)
        editComplainantModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplainantModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }

    //console.log(event)
};





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




const editComplaintTypeModal = document.getElementById("editComplaintTypeModal");
const editComplaintTypeModalCont = document.getElementById("editComplaintTypeModalCont");
const editComplaintTypeModalExit = document.getElementById("editComplaintTypeModalExit");
const editComplaintTypeModalExitIcon = document.getElementById("editComplaintTypeModalExitIcon");
const editComplaintTypeModalCancel = document.getElementById("editComplaintTypeModalCancel");
const editComplaintTypeModalBackground = document.getElementById("body-background");

function showEditComplaintTypeModal() {
    editComplaintTypeModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintTypeModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplaintTypeModal(event) {
    if (editComplaintTypeModalExit == event.target || editComplaintTypeModalExitIcon == event.target || editComplaintTypeModalCancel == event.target) {
        console.log(event)
        editComplaintTypeModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaintTypeModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }

    //console.log(event)
};






const editComplaintDescModal = document.getElementById("editComplaintDescModal");
const editComplaintDescModalCont = document.getElementById("editComplaintDescModalCont");
const editComplaintDescModalExit = document.getElementById("editComplaintDescModalExit");
const editComplaintDescModalExitIcon = document.getElementById("editComplaintDescModalExitIcon");
const editComplaintDescModalCancel = document.getElementById("editComplaintDescModalCancel");
const editComplaintDescModalBackground = document.getElementById("body-background");

function showEditComplaintDescModal() {
    editComplaintDescModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintDescModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplaintDescModal(event) {
    if (event.target == editComplaintDescModal || editComplaintDescModalExit == event.target || editComplaintDescModalExitIcon == event.target || editComplaintDescModalCancel == event.target) {
        editComplaintDescModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaintDescModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }
};







const editComplaintProofModalCont = document.getElementById("editComplaintProofModalCont");
const editComplaintProofModalExit = document.getElementById("editComplaintProofModalExit");
const editComplaintProofModalExitIcon = document.getElementById("editComplaintProofModalExitIcon");
const editComplaintProofModal = document.getElementById("editComplaintProofModal");
const editComplaintProofModalCancel = document.getElementById("editComplaintProofModalCancel");
const editComplaintProofModalBackground = document.getElementById("body-background");

function showEditComplaintProofModal() {
    editComplaintProofModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editComplaintProofModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditComplaintProofModal(event) {
    if (event.target == editComplaintProofModal || editComplaintProofModalExit == event.target || editComplaintProofModalExitIcon == event.target || editComplaintProofModalCancel == event.target) {
        editComplaintProofModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaintProofModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }
};


$("#select-new-complainant").selectize({
    maxItems: null,
});

$("#select-new-complainee").selectize({
    maxItems: null,
});