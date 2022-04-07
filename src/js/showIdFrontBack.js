const frontIdInput = document.getElementById("front_id");
const frontIdPreview = document.getElementById("front_id_preview");
const backIdInput = document.getElementById("back_id");
const backIdPreview = document.getElementById("back_id_preview");

frontIdInput.addEventListener("change", function () {
    previewImage(this, frontIdPreview);
});

backIdInput.addEventListener("change", function () {
    previewImage(this, backIdPreview);
});

function previewImage(inputImg, previewImg) {
    let reader = new FileReader();
    reader.readAsDataURL(inputImg.files[0]);

    reader.onload = function (e) {
        previewImg.src = e.target.result;
    };
};