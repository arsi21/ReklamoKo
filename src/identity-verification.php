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

                    <h2 class="home-card__sec__title">Identity Verification</h2>

                    <div class="home-card__indication__cont">
                        <div class="home-card__indication home-card__indication--active">1</div>
                        <div class="home-card__indication">2</div>
                        <div class="home-card__indication">3</div>
                    </div>

                    <label class="home-card__lbl" for="fname_input">First Name</label>
                    <input id="fname_input" class="home-card__input" type="text" name="fname" required>

                    <label class="home-card__lbl" for="mname_input">Middle Name (if applicable)</label>
                    <input id="mname_input" class="home-card__input" type="text" name="mname">

                    <label class="home-card__lbl" for="lname_input">Last Name</label>
                    <input id="lname_input" class="home-card__input" type="text" name="lname" required>

                    <label class="home-card__lbl" for="birth_date_input">Date of Birth</label>
                    <input id="birth_date_input" class="home-card__input" type="date" name="birthDate" required>

                    <p class="home-card__lbl">Gender</p>

                    <label class="home-card__radio__lbl" for="female_input">Female
                        <input id="female_input" class="home-card__input" type="radio" name="gender" required>
                        <span class="dotmark"></span>
                    </label>

                    <label class="home-card__radio__lbl" for="male_input">Male
                        <input id="male_input" class="home-card__input" type="radio" name="gender">
                        <span class="dotmark"></span>
                    </label>

                    <label class="home-card__lbl" for="email_input">Email</label>
                    <input id="email_input" class="home-card__input" type="email" name="email" required>

                    <label class="home-card__lbl" for="position_input">Position</label>
                    <select class="home-card__select" name="position" id="position_input" required>
                        <option value="resident">Resident</option>
                        <option value="official">Official</option>
                    </select>

                    <label class="home-card__lbl" for="street_input">Street</label>
                    <input id="street_input" class="home-card__input" type="text" name="street" required>

                    <label class="home-card__lbl" for="barangay_input">Barangay</label>
                    <input id="barangay_input" class="home-card__input" type="text" name="barangay" required>

                    <label class="home-card__lbl" for="municipality_input">Municipality</label>
                    <input id="municipality_input" class="home-card__input" type="text" name="municipality" required>

                    <label class="home-card__lbl" for="province_input">Province</label>
                    <input id="province_input" class="home-card__input" type="text" name="province" required>

                    <input class="home-card__button" type="submit" value="Continue">
                </form>
            </div>

            <img class="home-card__img" src="assets/signUpImg.svg" alt="">
        </section>
    </div>
</body>

</html>