<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ReklamoKo</title>
</head>

<body class="home-body">
    <header class="landing-header">
        <a href="#" class="home__logo">Reklamo<span class="logo-span">Ko</span></a>

        <img id="mobile-btn" class="mobile-menu-open" src="assets/icons/mobile-menu.svg" alt="Mobile menu">

        <nav class="landing-nav">
            <img id="mobile-exit" class="mobile-menu-exit" src="assets/icons/mobile-exit.svg" alt="Exit menu">

            <ul class="landing-pri-nav">
                <li><a href="login.php">Login</a></li>
                <li><a class="sign-up-cta" href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero-left-column">
            <h1 class="hero-header"><span>Complaints</span> Report Website</h1>
            <h2 class="hero-sub-header">A website that helps you to report your complaints easily.</h2>
            <button id="signup" class="start-now-btn">Start Now</button>
        </div>
        <div class="hero-img"><img src="assets/heroImg.svg" alt=""></div>
    </section>

    <footer class="landing-footer">
        <p>&copy; 2022 ReklamoKo</p>
    </footer>

    <script>
        //for mobile menu
        const mobileBtn = document.getElementById('mobile-btn');
        nav = document.querySelector('nav')
        mobileBtnExit = document.getElementById('mobile-exit');

        mobileBtn.addEventListener('click', () => {
            nav.classList.add('menu-btn');
        })

        mobileBtnExit.addEventListener('click', () => {
            nav.classList.remove('menu-btn');

        })


        //for redirecting to signup page using signup button
        const signupBtn = document.querySelector('#signup');

        signupBtn.addEventListener('click', function () {
            location.href = "signup.php";
        });

    </script>
</body>

</html>