const editProfileModalCont = document.getElementById("editProfileModalCont");
const editProfileModalExit = document.getElementById("editProfileModalExit");
const editProfileModalExitIcon = document.getElementById("editProfileModalExitIcon");
const editProfileModal = document.getElementById("editProfileModal");
const editProfileModalCancel = document.getElementById("editProfileModalCancel");
const editProfileModalBackground = document.getElementById("body-background");

function showEditProfileModal() {
    editProfileModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editProfileModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditProfileModal(event) {
    if (event.target == editProfileModal || editProfileModalExit == event.target || editProfileModalExitIcon == event.target || editProfileModalCancel == event.target) {
        editProfileModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editProfileModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }
};




const editPasswordModalCont = document.getElementById("editPasswordModalCont");
const editPasswordModalExit = document.getElementById("editPasswordModalExit");
const editPasswordModalExitIcon = document.getElementById("editPasswordModalExitIcon");
const editPasswordModal = document.getElementById("editPasswordModal");
const editPasswordModalCancel = document.getElementById("editPasswordModalCancel");
const editPasswordModalBackground = document.getElementById("body-background");

function showEditPasswordModal() {
    editPasswordModal.classList.toggle("modal2--add--comp--active");//to show and hide modal
    editPasswordModalBackground.classList.toggle("body-background--noscroll");//to remove the scroll in body
};

function hideEditPasswordModal(event) {
    if (event.target == editPasswordModal || editPasswordModalExit == event.target || editPasswordModalExitIcon == event.target || editPasswordModalCancel == event.target) {
        editPasswordModal.classList.remove("modal2--add--comp--active");//to show and hide modal
        editPasswordModalBackground.classList.remove("body-background--noscroll");//to remove the scroll in body
    }
};






const togglePwd = document.getElementById('toggle_pwd');
const pwdInput = document.getElementById('password_input');
const confirmPwdInput = document.getElementById('confirm_pass_input');

togglePwd.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
    pwdInput.setAttribute('type', type);
    confirmPwdInput.setAttribute('type', type);
});