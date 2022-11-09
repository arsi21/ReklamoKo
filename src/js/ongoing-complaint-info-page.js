const modal = document.getElementById("modal");
const modalCont = document.getElementById("modalCont");
const modalExit = document.getElementById("modalExit");
const modalCancel = document.getElementById("modalCancel");
const modalBackground = document.getElementById("body-background");

function showNextMeetingModal() {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
}


modalExit.addEventListener('click', () => {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modalCancel.addEventListener('click', () => {
    modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modal.addEventListener('click', function (event) {
    if (!modalCont.contains(event.target) && nextMeetingBtn != event.target) {
        modal.classList.toggle("modal2--add--comp--active");//to show and hide modal
        modalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});