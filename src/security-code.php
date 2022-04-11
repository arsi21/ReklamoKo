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
                    <h1 class="home-card__title">Enter security code</h1>
                    <p class="home-card__p">Please check your mobile phone for a message with your
                        code. Your code is 6 numbers long.
                    </p>

                    <div class="home-card__mobile__cont">
                        <input id="code_input" class="home-card__input" type="text" name="secuCode"
                            placeholder="Enter code">

                        <div class="home-card__mobile__num">
                            <p class="">We sent your code to:</p>
                            <p class="">09268780822</p>
                        </div>
                    </div>

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