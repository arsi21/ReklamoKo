//const portraitPicInput = document.getElementById("portrait_pic_input");
const picPreview1 = document.getElementById("pic_preview1");
const picPreview2 = document.getElementById("pic_preview2");
const picPreview3 = document.getElementById("pic_preview3");

// portraitPicInput.addEventListener("change", function () {
//     previewImage(this, portraitPicPreview);
// });

function previewImage(inputImg, previewImg) {
    let reader = new FileReader();
    reader.readAsDataURL(inputImg.files[0]);

    reader.onload = function (e) {
        previewImg.src = e.target.result;
    };
};