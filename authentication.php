
<?php include_once "header.php"; ?> 
<?php 


if(!isset($_SESSION["authenticated"])){

    $_SESSION["status"] = "Please Login to access User Dashboard.!";
    header("location:login.php");
    exit(0); // exit means er por r kono code show korbe na
}

?>