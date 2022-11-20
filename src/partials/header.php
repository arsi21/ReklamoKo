<?php
include_once 'includes/check-access.php';

if(!isset($_SESSION)){
    session_start();
}

//get the resident id
$residentId = $_SESSION['residentId'];


include_once "classes/dbh.php";
include_once "classes/resident.php";
include_once "classes/complaint-type.php";

//Instantiate Class
$resident = new Resident();
$complaintType = new ComplaintType();

//get data from database
$residentsData = $resident->getResidents();
$complaintTypesData = $complaintType->getComplaintType();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.js"></script>
    <title>ReklamoKo</title>
</head>

<body id="body-background" class="body-background">
    <div id="body-wrapper" class="body-wrapper">
        <header class="header">
            <div class="header__left__col">
                <img id="menu-btn" class="header__menu" src="assets/icons/menu.svg" alt="Menu icon">

                <a class="header__logo" href="#">ReklamoKo</a>
            </div>

            <div class="header__tool">
                <ul>
                    <!-- <li id="inbox-btn" class="header__inbox__cont">
                        <svg class="header__inbox" xmlns="http://www.w3.org/2000/svg" width="34.873" height="26.154" viewBox="0 0 34.873 26.154">
                            <path id="inbox" d="M0,3V29.154H34.873V3ZM9.623,14.521l-6.717,8.3V9.078l6.717,5.443ZM3.606,5.906H31.265L17.436,17.113,3.606,5.906ZM11.88,16.35l5.556,4.5L23,16.343l8.154,9.905H3.869Zm13.379-1.837,6.707-5.436V22.661l-6.707-8.147Z" transform="translate(0 -3)"/>
                        </svg>

                        <span class="message-counter">2</span>
                    </li>

                    <li id="notif-btn" class="header__notif__cont">
                        <svg class="header__notif" xmlns="http://www.w3.org/2000/svg" width="29.242" height="35.09" viewBox="0 0 29.242 35.09">
                            <path id="notification" d="M21.007,30.7a4.483,4.483,0,0,1-4.344,4.386A4.559,4.559,0,0,1,12.235,30.7Zm.2-24.936a3.074,3.074,0,0,1-1.522-2.661v0a3.066,3.066,0,1,0-6.131,0v0a3.07,3.07,0,0,1-1.522,2.661C5.208,9.729,9.131,22.9,2,25.223V27.78H31.242V25.223C24.111,22.9,28.036,9.727,21.208,5.768ZM16.621,1.462a1.462,1.462,0,1,1-1.462,1.462A1.464,1.464,0,0,1,16.621,1.462ZM7.189,24.856c1.738-2.437,2.347-5.689,2.872-8.5.654-3.494,1.271-6.8,3.442-8.055a6.112,6.112,0,0,1,6.239,0c2.171,1.259,2.788,4.56,3.442,8.055.525,2.813,1.133,6.065,2.872,8.5Z" transform="translate(-2)"/>
                        </svg>

                        <span class="notif-counter">5</span>
                    </li> -->

                    <li id="account-btn" class="header__profile">
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
                    </li>
                </ul>
            </div>
        </header>









        <!-- <div id="modal-message" class="modal modal--message">
            <span class="modal__title">Message</span>
            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>
        </div>










        <div id="modal-notif" class="modal modal--notif">
            <span class="modal__title">Notification</span>
            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>

            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>


            <div class="modal__item modal__item--read">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>


            <div class="modal__item">
                <div class="modal__item__img__cont">
                    <img class="modal__item__img" src="assets/adminProfSample.jpg " alt="">
                </div>

                <div class="modal__item__info">
                    <div class="modal__item__info__top">
                        <span class="modal__item__pos">Secretary</span>
                        <span class="modal__item__date">9:00 AM</span>
                    </div>

                    <span class="modal__item__name">John Smith</span>
                    <span class="modal__item__desc">Approve your complain.</span>
                </div>
            </div>
        </div> -->









        <div id="modal-account" class="modal modal--account">
            <span class="modal__title">Account</span>
            <div class="modal__acc__cont">
                <div class="modal__acc__pic__cont">
                        <?php 
                            if($_SESSION['profile'] != ""){
                        ?>
                                <img class="modal__acc__pic" src="profile-uploads/<?= $_SESSION['profile'] ?>" alt="Profile picture">
                        <?php 
                            }else{
                        ?>
                                <img class="modal__acc__pic" src="profile-uploads/default.jpg" alt="Profile picture">
                        <?php 
                            }
                        ?>
                </div>

                <div class="modal__acc__info">
                    <span class="modal__acc__pos"><?= ucwords($_SESSION['accessType']); ?></span>
                    <span class="modal__acc__name"><?php echo ucwords($_SESSION['firstName']) . " " . ucwords($_SESSION['lastName']); ?></span>
                    <span class="modal__acc__uname"><?= ucwords($_SESSION['mobileNumber']); ?></span>
                </div>
            </div>

            <div class="modal__acc__action">
                <a class="link" href="account-info.php">Manage your account</a>

                <a class="modal__acc__btn" href="includes/logout.php">Log Out</a>
            </div>
        </div>