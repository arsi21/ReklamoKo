<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ReklamoKo | Signup</title>
</head>

<body class="home-card-background">
    <div class="home-wrapper">
        <header>
            <a href="index.php" class="home__logo">Reklamo<span class="logo-span">Ko</span></a>
        </header>

        <section class="home-card home-card--with--img">
            <div class="home-card__container home-card__left">
                <form class="home-card__form" action="">
                    <h1 class="home-card__title">Sign Up</h1>

                    <h2 class="home-card__sec__title">Welcome to ReklamoKo!</h2>

                    <label class="home-card__lbl" for="mobile_input">Mobile</label>
                    <input id="mobile_input" class="home-card__input" type="number" name="uname">

                    <label class="home-card__lbl" for="password_input">Password</label>
                    <input id="password_input" class="home-card__input home-card__input--pass" type="password"
                        name="password">
                    <i class="eye" id="toggle_pwd"></i>

                    <label class="home-card__lbl" for="password_input">Confirm Password</label>
                    <input id="con_password_input" class="home-card__input home-card__input--pass" type="password"
                        name="conPassword">
                    <i class="eye" id="toggle_con_pwd"></i>

                    <div class="home-card__checkbox">
                        <label class="home-card__checkbox__lbl" for="agree_terms">I have read and agree to the
                            Terms of
                            Service.

                            <input type="checkbox" id="agree_terms" name="agreeTerms" value="Yes">
                            <span class="home-card__checkmark"></span>
                        </label>

                        <a class="link" href="#">ReklamoKo Terms</a>
                    </div>

                    <input class="home-card__button" type="submit" value="Create Account">
                </form>

                <p class="home-card__p">Have already an account? <a class="link" href="login.php">Login here</a></p>
            </div>

            <img class="home-card__img" src="assets/signUpImg.svg" alt="">
        </section>
    </div>

    <script>
        const togglePwd = document.querySelector('#toggle_pwd');
        const pwdInput = document.querySelector('#password_input');
        const toggleConPwd = document.querySelector('#toggle_con_pwd');
        const conPwdInput = document.querySelector('#con_password_input');

        togglePwd.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
            pwdInput.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('eye-slash');
        });

        toggleConPwd.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = conPwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
            conPwdInput.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('eye-slash');
        });
    </script>
</body>

</html>