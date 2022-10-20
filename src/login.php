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

                <?php 
                    if(isset($_GET['message'])){
                        if($_GET['message'] == "userNotFound"){
                ?>

                    <div class="form-error">
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
                        <p>
                            User not found.
                        </p>
                    </div>

                <?php 
                        }elseif($_GET['message'] == "didNotMatch"){
                ?>

                    <div class="form-error">
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
                        <p>
                            Mobile number and password didn't match.
                        </p>
                    </div>

                <?php 
                        }elseif($_GET['message'] == "emptyInput"){
                ?>

                    <div class="form-error">
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
                        <p>
                            Please make sure that you provide all the needed information.
                        </p>
                    </div>

                <?php 
                        }
                    }
                ?>


                    <label class="home-card__lbl" for="username_input">Mobile Number</label>
                    <input id="username_input" class="home-card__input" type="number" name="mobileNumber" value="<?php if(isset($_GET['mobileNumber'])) echo $_GET['mobileNumber'] ?>" required>

                    <label class="home-card__lbl" for="password_input">Password</label>
                    <input id="password_input" class="home-card__input home-card__input--pass" type="password"
                        name="password" required>
                    <i class="eye" id="toggle_pwd"></i>

                    <div>
                        <input class="home-card__button" type="submit" value="Log In" name="submitBtn">
                    </div>
                </form>

                <!-- <a class="home-card__forgot link" href="find-account.php">Forgot password?</a> -->

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