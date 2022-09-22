<?php 
 //start session
if(!isset($_SESSION)){
    session_start();
}

//check if they login
if(!isset($_SESSION['accessType'])){
    header("location:login.php");
}