const portraitPicInput = document.getElementById("portrait_pic_input");
const portraitPicPreview = document.getElementById("portrait_pic_preview");

portraitPicInput.addEventListener("change", function () {
    previewImage(this, portraitPicPreview);
});

function previewImage(inputImg, previewImg) {
    let reader = new FileReader();
    reader.readAsDataURL(inputImg.files[0]);

    reader.onload = function (e) {
        previewImg.src = e.target.result;
    };
};