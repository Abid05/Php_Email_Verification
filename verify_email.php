<?php 
include_once "connection_db.php";
session_start();

if(isset($_REQUEST["token"])){

    $token = $_REQUEST["token"];
    $verify_token_query = "SELECT * FROM user_info WHERE verify_token ='$token'";
    $verify_token_query_run = mysqli_query($con, $verify_token_query);
    $count = mysqli_num_rows($verify_token_query_run);

    if($count > 0){

        $row = mysqli_fetch_assoc($verify_token_query_run);
        $db_token  = $row["verify_token"];
        $db_status = $row["verify_status"];

        if($db_status == 0){

            $status_update ="UPDATE user_info SET verify_status = '1' WHERE verify_token = '$db_token'";
            $status_update_query_run = mysqli_query($con,$status_update);

            if($status_update_query_run){

                $_SESSION["status"] = "Your account is verified successfully.!";
                header("location:login.php");
                exit(0);
            }else{

                $_SESSION["status"] = "Verification Failed.!";
                header("location:login.php");
                exit(0);

            }

        }else{

            $_SESSION["status"] = "Email already verified.Please login";
            header("location:login.php");
            exit(0);
        }
    }else{

        $_SESSION["status"] = "This token doesnot exits";
        header("location:login.php");
        exit(0);

    }


}else{

    $_SESSION["status"] = "Not Allowed";
    header("location:login.php");
}

?>