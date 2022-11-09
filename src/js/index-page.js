//for mobile menu
const mobileBtn = document.getElementById('mobile-btn');
nav = document.querySelector('nav')
mobileBtnExit = document.getElementById('mobile-exit');

mobileBtn.addEventListener('click', () => {
    nav.classList.add('menu-btn');
})

mobileBtnExit.addEventListener('click', () => {
    nav.classList.remove('menu-btn');

})


//for redirecting to signup page using signup button
const signupBtn = document.querySelector('#signup');

signupBtn.addEventListener('click', function () {
    location.href = "signup.php";
});