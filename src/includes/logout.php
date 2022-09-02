<?php

session_start();

//for destroying session
session_unset();
session_destroy();

//Redirect to page
header("location: ../login.php");