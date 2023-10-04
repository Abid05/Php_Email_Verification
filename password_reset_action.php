<?php
 session_start(); 
 include_once "connection_db.php";
 include('smtp/PHPMailerAutoload.php');
function send_password_reset($db_email,$subject,$token){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "tls"; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->Username = "sazzadhossainabid@gmail.com";
	$mail->Password = "cmisbwnvyevokeaf";
	$mail->SetFrom("sazzadhossainabid@gmail.com");
	$mail->Subject = "Reset Passsword Notification";
	$mail->Body ="
    
        <h2>Please confirm your account registration by clicking the button or link below:</h2>
        <a href='http://localhost:3000/password_change.php?token=$token&email=$db_email'>Click Here</a>
    
    ";
	$mail->AddAddress($db_email);
    $mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'      =>false,
		'verify_peer_name' =>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}



if(isset($_REQUEST["password_reset_link"])){

    $email = mysqli_real_escape_string($con,$_REQUEST["email"]);
    $token = md5(rand());
    $cheak_mail_query = "SELECT * FROM user_info WHERE  email = '$email'";
    $cheak_mail_query_run = mysqli_query($con,$cheak_mail_query);
    $count = mysqli_num_rows($cheak_mail_query_run);

    if($count > 0){
        $row = mysqli_fetch_assoc($cheak_mail_query_run);
        $db_email = $row['email'];
        $update_token_query = "UPDATE user_info SET verify_token = '$token' WHERE email = '$db_email'";
        $update_token_query_run = mysqli_query($con,$update_token_query);

        if($update_token_query_run){

            send_password_reset($db_email,$subject,$token);
            $_SESSION["status"] = "We e-mailed you a password reset link.!";
            header("location:password_reset.php");
            exit(0);


        }else{

            $_SESSION["status"] = "Something went wrong.!";
            header("location:password_reset.php");
            exit(0);
        }

    }else{
        $_SESSION["status"] = "No Email Found";
        header("location:password_reset.php");
        exit(0);
    }

}

//password_change.php


if(isset($_REQUEST["password_update"])){

    $email = mysqli_real_escape_string($con,$_REQUEST["email"]);
    $new_pass = mysqli_real_escape_string($con,$_REQUEST["new_pass"]);
    $confirm_pass = mysqli_real_escape_string($con,$_REQUEST["confirm_pass"]);
    $token = mysqli_real_escape_string($con,$_REQUEST["pass_reset_token"]);

    //token available or not cheak
    if(!empty($token)){

        if(!empty($email) && !empty($new_pass) && !empty($confirm_pass) ){
            
            //checking token valid(means correct) or not
            $check_token = "SELECT * FROM user_info Where verify_token = '$token' LIMIT 1 ";
            $check_token_run = mysqli_query($con,$check_token);
            $count = mysqli_num_rows($check_token_run);

            if($count > 0){

                if($new_pass == $confirm_pass){
                    $update_pass = "UPDATE user_info SET password = '$new_pass' WHERE verify_token = '$token' LIMIT 1";
                    $update_pass_run = mysqli_query($con,$update_pass);

                    if( $update_pass_run ){

                        $new_token = md5(rand());
                        $new_token_update =  "UPDATE user_info SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                        $new_token_update_run = mysqli_query($con,$new_token_update );

                        $_SESSION["status"] = "New Password Successfully Update.!";
                        header("location:login.php");
                        exit(0);

                    }else{
                        $_SESSION["status"] = "Didn't Update Password.Something went wrong.!";
                        header("location:password_change.php?token=$token&email=$email");
                        exit(0);
                    }

                }else{
                    $_SESSION["status"] = "Password & Confirm Password Doesn't Match";
                    header("location:password_change.php?token=$token&email=$email");
                    exit(0);
                }
                
            }else{

                $_SESSION["status"] = "Invalid Token";
                header("location:password_change.php?token=$token&email=$email");
                exit(0);
            }

        }else{
            $_SESSION["status"] = "All File Are Mendetory";
            header("location:password_change.php?token=$token&email=$email");
            exit(0);
        }

    }else{

        $_SESSION["status"] = "No Token Available";
        header("location:password_change.php");
        exit(0);
    }




}
