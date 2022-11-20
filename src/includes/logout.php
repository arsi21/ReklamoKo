<?php

session_start();

$userId = $_SESSION['userId'];
$name = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
$actionMade = "Logged out to the system";

//for destroying session
session_unset();
session_destroy();

//include needed files
include "../classes/logger.php";

//add log
$log = new Logger("log.txt");
$log->setTimestamp("Y-m-d H:i:s");
$log->putLog("UserId={$userId} {$name} {$actionMade}");

//Redirect to page
header("location: ../login.php");