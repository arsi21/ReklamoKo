<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ReklamoKo | Forget Password</title>
</head>

<body class="home-card-background">
    <div class="home-wrapper">
        <header>
            <a href="index.php" class="home__logo">Reklamo<span class="logo-span">Ko</span></a>
        </header>

        <section class="home-card home-card--no--img">
            <div class="home-card__container">
                <form class="home-card__form" action="">
                    <h1 class="home-card__title">Authentication</h1>

                    <div class="home-card__auth__cont">
                        <img src="assets/icons/inbox.svg" alt="Message icon">
                        <p class="home-card__p">Please enter the 6-digit code that was sent to
                            09123456789. The code is valid for 30 minutes.
                        </p>
                    </div>

                    <p class="home-card__p">Enter Authentication Code</p>

                    <input id="code_input" class="home-card__input" type="number" name="authCode"
                        placeholder="Authentication code">

                    <a id="resendCode" class="home-card__resend">Resend Code</a>

                    <input class="home-card__button" type="submit" value="Submit">
                </form>
            </div>
        </section>
    </div>
</body>

</html>