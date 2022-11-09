const togglePwd = document.querySelector('#toggle_pwd');
const pwdInput = document.querySelector('#password_input');

togglePwd.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
    pwdInput.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('eye-slash');
});