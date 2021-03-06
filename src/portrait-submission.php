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

                    <h2 class="home-card__sec__title">Portrait photo submission</h2>

                    <div class="home-card__indication__cont">
                        <div class="home-card__indication home-card__indication--done"><img src="assets/icons/check.svg"
                                alt=""></div>
                        <div class="home-card__indication home-card__indication--done"><img src="assets/icons/check.svg"
                                alt=""></div>
                        <div class="home-card__indication home-card__indication--active">3</div>
                    </div>

                    <p class="home-card__p">Upload portrait photo</p>

                    <label class="home-card__file__lbl" for="portrait_pic_input">
                        <input id="portrait_pic_input" class="home-card__input__file" type="file"
                            name="portraitPicInput">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload photo</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="portrait_pic_preview" />
                    </div>

                    <input class="home-card__button" type="submit" value="Submit">
                </form>
            </div>

            <img class="home-card__img" src="assets/signUpImg.svg" alt="">
        </section>
    </div>

    <script src="js/showPortraitPic.js"></script>
</body>

</html>