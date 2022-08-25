<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>

    <title>ReklamoKo | Signup</title>
</head>

<body class="home-card-background">
    <div class="home-wrapper">
        <header>
            <a href="index.php" class="home__logo">Reklamo<span class="logo-span">Ko</span></a>
        </header>



        <form data-multi-step id="signupForm" action="" method="post">

            <!-- Identity verification -->

            <section data-step class="step-form">
                <div class="home-card home-card--with--img">
                    <div class="home-card__container home-card__left">
                        <div class="home-card__form">
                            <h1 class="home-card__title">Sign Up</h1>

                            <h2 class="home-card__sec__title">Identity Verification</h2>

                            <div class="home-card__indication__cont">
                                <div class="home-card__indication home-card__indication--active">1</div>
                                <div class="home-card__indication">2</div>
                                <div class="home-card__indication">3</div>
                            </div>

                            <label class="home-card__lbl" for="fname_input">First Name</label>
                            <input id="fname_input" class="home-card__input" type="text" name="firstName" required>

                            <label class="home-card__lbl" for="mname_input">Middle Name (if applicable)</label>
                            <input id="mname_input" class="home-card__input" type="text" name="middleName">

                            <label class="home-card__lbl" for="lname_input">Last Name</label>
                            <input id="lname_input" class="home-card__input" type="text" name="lastName" required>

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

                            <label class="home-card__lbl" for="house_number_input">House Number</label>
                            <input id="house_number_input" class="home-card__input" type="number" name="houseNumber" required>

                            <label class="home-card__lbl" for="street_input">Street</label>
                            <input id="street_input" class="home-card__input" type="text" name="street" required>

                            <label class="home-card__lbl" for="barangay_input">Barangay</label>
                            <input id="barangay_input" class="home-card__input" type="text" name="barangay" required>

                            <label class="home-card__lbl" for="municipality_input">Municipality</label>
                            <input id="municipality_input" class="home-card__input" type="text" name="municipality" required>

                            <label class="home-card__lbl" for="province_input">Province</label>
                            <input id="province_input" class="home-card__input" type="text" name="province" required>

                            <label class="home-card__lbl" for="postal_number_input">Postal Number</label>
                            <input id="postal_number_input" class="home-card__input" type="number" name="postalNumber" required>

                            <div class="multi-step-form-btn-container">
                                <span data-next class="multi-step-form-btn-next">Continue</span>
                            </div>
                        </div>
                    </div>

                    <img class="home-card__img" src="assets/signUpImg.svg" alt="">
                </div>
            </section>








            <!-- Id verification -->

            <section data-step class="step-form">
                <div class="home-card home-card--with--img">
                    <div class="home-card__container home-card__left">
                        <div class="home-card__form">
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
                                <input id="front_id" class="home-card__input__file" type="file" name="frontId" required>
                                <img src="assets/icons/upload.svg" alt="Upload icon">
                                <span>Upload front page</span>
                            </label>

                            <div class="home-card__img__preview">
                                <img id="front_id_preview" />
                            </div>

                            <label class="home-card__file__lbl" for="back_id">
                                <input id="back_id" class="home-card__input__file" type="file" name="backId" required>
                                <img src="assets/icons/upload.svg" alt="Upload icon">
                                <span>Upload back page</span>
                            </label>

                            <div class="home-card__img__preview">
                                <img id="back_id_preview" />
                            </div>

                            <div class="multi-step-form-btn-container">
                                <span data-previous class="multi-step-form-btn-prev">Previous</span>
                                <span data-next class="multi-step-form-btn-next">Continue</span>
                            </div>
                        </div>
                    </div>

                    <img class="home-card__img" src="assets/signUpImg.svg" alt="">
                </div>
            </section>



            <!-- Identity verification -->

            <section data-step class="step-form">
                <div class="home-card home-card--with--img">
                    <div class="home-card__container home-card__left">
                        <div class="home-card__form">
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
                                    name="portraitPhoto" required>
                                <img src="assets/icons/upload.svg" alt="Upload icon">
                                <span>Upload photo</span>
                            </label>

                            <div class="home-card__img__preview">
                                <img id="portrait_pic_preview" />
                            </div>

                            <!-- <div class="multi-step-form-btn-container">
                                <span data-previous class="multi-step-form-btn-prev">Previous</span>
                                <span data-next class="multi-step-form-btn-next">Continue</span>
                            </div> -->
                            
                            <input class="home-card__button" type="submit" name="submit" value="Submit">
                        </div>
                    </div>

                    <img class="home-card__img" src="assets/signUpImg.svg" alt="">
                </div>
            </section>

        </form>


    </div>
    <script src="js/showNextForm.js"></script>
    <script src="js/showIdFrontBack.js"></script>
    <script src="js/showPortraitPic.js"></script>
</body>

</html>