  <nav  id="nav" class="nav">
            <div class="nav__profile">
                <div class="nav__profile__pic">
                    <img src="assets/residentProfSample.jpg " alt="Profile picture">
                </div>

                <div class="nav__profile__info">
                    <span class="nav__name"><?php echo ucwords($_SESSION['firstName']) . " " . ucwords($_SESSION['lastName']); ?></span>

                    <span class="nav__position"><?= ucwords($_SESSION['access']); ?></span>

                </div>
            </div>

            <hr class="nav__hr">


    <?php
        if($_SESSION['access'] == "resident"){
    ?>
            <button id="add-complain-btn" class="nav__complain__btn">
                <img src="assets/icons/add.svg" alt="Add icon">
                <span>Complain</span>
            </button>

    <?php
        }
    ?>


            <ul>

    <?php
        if($_SESSION['access'] == "admin" || $_SESSION['access'] == "official"){
    ?>
                <li>
                    <a id="nav-dashboard" href="dashboard.php" class="nav__dashboard">
                        <img src="assets/icons/dashboard.svg" alt="Dashboard icon">
                        <span>Dashboard</span>
                    </a>
                </li>
    <?php
        }
    ?>

                <li>
                    <a id="nav-pending" href="pending-complaints.php" class="nav__pending">
                        <img src="assets/icons/pending_complaints.svg" alt="Pending complaints icon">
                        <span>Pending Complaints</span>
                    </a>
                </li>

                <li>
                    <a id="nav-ongoing" href="on-going-complaints.php" class="nav__ongoing">
                        <img src="assets/icons/ongoing_complaints.svg" alt="On going complaints icon">
                        <span>On Going Complaints</span>
                    </a>
                </li>

                <li>
                    <a id="nav-transferred" href="transferred-complaints.php" class="nav__transferred">
                        <img src="assets/icons/transferred_complaints.svg" alt="Transferred complaints icon">
                        <span>Transferred Complaints</span>
                    </a>
                </li>

                <li>
                    <a id="nav-solved" href="solved-complaints.php" class="nav__solved">
                        <img src="assets/icons/solved_complaints.svg" alt="Solved complaints icon">
                        <span>Solved Complaints</span>
                    </a>
                </li>

                
    <?php
        if($_SESSION['access'] == "admin"){
    ?>


                <hr class="nav__hr nav__hr--ad">


                <li>
                    <a href="submitted-applications.php" class="nav__ongoing">
                        <img src="assets/icons/submitted_application.svg" alt="On going complaints icon">
                        <span>Submitted Applications</span>
                    </a>
                </li>

                <li>
                    <a href="resident-accounts.php" class="nav__transferred">
                        <img src="assets/icons/resident-accounts.svg" alt="Transferred complaints icon">
                        <span>Resident Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="official-accounts.php" class="nav__solved">
                        <img src="assets/icons/official-accounts.svg" alt="Solved complaints icon">
                        <span>Official Accounts</span>
                    </a>
                </li>

    <?php
        }
    ?>
            </ul>
        </nav>