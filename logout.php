<?php session_start(); ?>

<?php

unset($_SESSION["authenticated"]); 

unset($_SESSION["auth_user"]);

$_SESSION["status"] = "You Are Logged Out Successfully.!";
header("location:login.php");

?>