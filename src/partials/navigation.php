  <nav  id="nav" class="nav">
        <a href="account-info.php">
            <div class="nav__profile">
                <div class="nav__profile__pic">
                        <?php 
                            if($_SESSION['profile'] != ""){
                        ?>
                                <img src="profile-uploads/<?= $_SESSION['profile'] ?>" alt="Profile picture">
                        <?php 
                            }else{
                        ?>
                                <img src="profile-uploads/default.jpg" alt="Profile picture">
                        <?php 
                            }
                        ?>
                </div>

                <div class="nav__profile__info">
                    <span class="nav__name"><?php echo ucwords($_SESSION['firstName']) . " " . ucwords($_SESSION['lastName']); ?></span>

                    <span class="nav__position"><?= ucwords($_SESSION['accessType']); ?></span>

                </div>
            </div>
        </a>

            <hr class="nav__hr">


    <?php
        if($_SESSION['accessType'] == "resident"){
    ?>
            <button id="add-complain-btn" class="nav__complain__btn" onclick="showAddComplaintModal()">
                <img src="assets/icons/add.svg" alt="Add icon">
                <span>Complaint</span>
            </button>

    <?php
        }
    ?>


            <ul>

    <?php
        if($_SESSION['accessType'] == "admin" || $_SESSION['accessType'] == "official"){
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
                    <a id="nav-ongoing" href="ongoing-complaints.php" class="nav__ongoing">
                        <img src="assets/icons/ongoing_complaints.svg" alt="Ongoing complaints icon">
                        <span>Ongoing Complaints</span>
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
        if($_SESSION['accessType'] == "admin"){
    ?>


                <hr class="nav__hr nav__hr--ad">


                <li>
                    <a href="submitted-applications.php" class="nav__ongoing">
                        <img src="assets/icons/submitted_application.svg" alt="Submitted applications icon">
                        <span>Submitted Applications</span>
                    </a>
                </li>

                <li>
                    <a href="resident-accounts.php" class="nav__transferred">
                        <img src="assets/icons/resident-accounts.svg" alt="Resident accounts icon">
                        <span>Resident Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="admin-accounts.php" class="nav__solved">
                        <img src="assets/icons/admin-accounts.svg" alt="Admin accounts icon">
                        <span>Admin Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="lupon.php" class="nav__solved">
                        <img src="assets/icons/official-accounts.svg" alt="Pacification commitee icon">
                        <span>Pacification Committees</span>
                    </a>
                </li>

                <li>
                    <a href="residents.php" class="nav__transferred">
                        <img src="assets/icons/resident-accounts.svg" alt="Resident accounts icon">
                        <span>Residents</span>
                    </a>
                </li>

    <?php
        }
    ?>
            </ul>
        </nav>