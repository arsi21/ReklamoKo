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
        //console.log(event)
        editComplaineeModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editComplaineeModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }

    //console.log(event)
};