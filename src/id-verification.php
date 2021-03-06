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

                    <h2 class="home-card__sec__title">ID Verification</h2>

                    <div class="home-card__indication__cont">
                        <div class="home-card__indication home-card__indication--done"><img src="assets/icons/check.svg"
                                alt=""></div>
                        <div class="home-card__indication home-card__indication--active">2</div>
                        <div class="home-card__indication">3</div>
                    </div>

                    <p class="home-card__p">Upload identification card</p>

                    <label class=" home-card__lbl" for="id_input">Select ID</label>
                    <select class="home-card__select" name="position" id="position_input">
                        <option value="resident">Postal ID</option>
                        <option value="official">National ID</option>
                        <option value="official">Driver's license</option>
                        <option value="official">Barangay ID</option>
                        <option value="official">Voter's ID</option>
                        <option value="official">Senior Citizen ID</option>
                        <option value="official">PRC ID</option>
                        <option value="official">SSS ID</option>
                        <option value="official">GSIS ID</option>
                        <option value="official">PWD ID</option>
                        <option value="official">PhilHealth ID</option>
                    </select>

                    <label class="home-card__file__lbl" for="front_id">
                        <input id="front_id" class="home-card__input__file" type="file" name="frontId">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload front page</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="front_id_preview" />
                    </div>

                    <label class="home-card__file__lbl" for="back_id">
                        <input id="back_id" class="home-card__input__file" type="file" name="backId">
                        <img src="assets/icons/upload.svg" alt="Upload icon">
                        <span>Upload back page</span>
                    </label>

                    <div class="home-card__img__preview">
                        <img id="back_id_preview" />
                    </div>


                    <input class="home-card__button" type="submit" value="Continue">
                </form>
            </div>

            <img class="home-card__img" src="assets/signUpImg.svg" alt="">
        </section>
    </div>


    <script src="js/showIdFrontBack.js"></script>
</body>

</html>