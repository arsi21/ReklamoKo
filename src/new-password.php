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
                    <h1 class="home-card__title">Choose a New Password</h1>
                    <p class="home-card__p">Create a new password that is at 6 characters long. A
                        strong password is combination of letters, numbers, and
                        punctuation marks.
                    </p>

                    <input id="pass_input" class="home-card__input" type="text" name="newPass"
                        placeholder="New Password">

                    <div class="home-card__btn__cont">
                        <input class="home-card__cancel__btn" type="submit" value="Cancel">
                        <input class="home-card__sec__btn" type="submit" value="Continue">
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>

</html>