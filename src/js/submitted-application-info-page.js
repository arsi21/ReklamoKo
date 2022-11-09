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