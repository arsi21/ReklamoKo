<?php

session_start();

$userId = $_SESSION['userId'];
$actionMade = "Logged out to the system";

//for destroying session
session_unset();
session_destroy();

//include needed files
include "../classes/dbh.php";
include "../classes/log.php";
include "../classes/log-controller.php";

$logController = new LogController();

$logController->addLog($userId, $actionMade);

//Redirect to page
header("location: ../login.php");