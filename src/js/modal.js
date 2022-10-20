const modal2 = document.getElementById("modal2");
const modal2Cont = document.getElementById("modal2-cont");
const modal2Exit = document.getElementById("modal2-exit");
const modal2Cancel = document.getElementById("modal2-cancel");
const bodyBackground = document.getElementById("body-background");

function showAddComplaintModal() {
    modal2.classList.toggle("modal2--add--comp--active");//to show and hide modal
    bodyBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

modal2Exit.addEventListener('click', () => {
    modal2.classList.toggle("modal2--add--comp--active");//to show and hide modal
    bodyBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modal2Cancel.addEventListener('click', () => {
    modal2.classList.toggle("modal2--add--comp--active");//to show and hide modal
    bodyBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
});

modal2.addEventListener('click', function (event) {
    if (!modal2Cont.contains(event.target)) {
        modal2.classList.toggle("modal2--add--comp--active");//to show and hide modal
        bodyBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
    }
});













// const portraitPicInput = document.getElementById("upload-pic");
// const portraitPicPreview = document.getElementById("portrait_pic_preview");

// portraitPicInput.addEventListener("change", function () {
//     previewImage(this, portraitPicPreview);
// });

// function previewImage(inputImg, previewImg) {
//     let reader = new FileReader();
//     reader.readAsDataURL(inputImg.files[0]);

//     reader.onload = function (e) {
//         previewImg.src = e.target.result;
//     };
// };