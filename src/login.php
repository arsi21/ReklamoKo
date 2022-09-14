<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ReklamoKo | Login</title>
</head>

<body class="home-card-background">
    <div class="home-wrapper">
        <header>
            <a href="index.php" class="home__logo">Reklamo<span class="logo-span">Ko</span></a>
        </header>

        <section class="home-card home-card--with--img">
            <div class="home-card__container home-card__left">
                <form class="home-card__form" action="./includes/login-user.php" method="POST">
                    <h1 class="home-card__title">Log In</h1>

                    <label class="home-card__lbl" for="username_input">Mobile Number</label>
                    <input id="username_input" class="home-card__input" type="number" name="mobileNumber">

                    <label class="home-card__lbl" for="password_input">Password</label>
                    <input id="password_input" class="home-card__input home-card__input--pass" type="password"
                        name="password">
                    <i class="eye" id="toggle_pwd"></i>

                    <div>
                        <input class="home-card__button" type="submit" value="Log In" name="submitBtn">
                    </div>
                </form>

                <a class="home-card__forgot link" href="find-account.php">Forgot password?</a>

                <p class="home-card__p">Don't have an account? <a class="link" href="signup.php">Sign Up</a></p>
            </div>

            <img class="home-card__img" src="assets/loginImg.svg" alt="">
        </section>
    </div>

    <script>
        const togglePwd = document.querySelector('#toggle_pwd');
        const pwdInput = document.querySelector('#password_input');

        togglePwd.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
            pwdInput.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('eye-slash');
        });
    </script>
</body>

</html>