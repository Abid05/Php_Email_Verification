<?php
session_start();
include_once "connection_db.php";
include('smtp/PHPMailerAutoload.php');

function smtp_mailer($email,$subject,$verify_token){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "tls"; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->Username = "sazzadhossainabid@gmail.com";
	$mail->Password = "qjdxzfbekarxqana";
	$mail->SetFrom("sazzadhossainabid@gmail.com");
	$mail->Subject = "Account Verification";
	$mail->Body ="
    
        <h2>Please confirm your account registration by clicking the button or link below:</h2>
        <a href='http://localhost:3000/verify_email.php?token=$verify_token'>Click Here</a>
    
    ";
	$mail->AddAddress($email);
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

if(isset($_REQUEST["submit_registraion"])){

    $name         = $_REQUEST["name"];
    $email        = $_REQUEST["email"];
    $password     = $_REQUEST["password"];
    $verify_token = md5(rand());
    
        //Email exixts or not

        $check_mail_query = "SELECT * FROM user_info WHERE email = '$email'";

        $check_mail_query_run = mysqli_query($con,$check_mail_query);

        $count = mysqli_num_rows($check_mail_query_run);

        if($count > 0){

        $_SESSION["status"] = "Email is already exixts";

        header("location:registration.php");

        }else{

         //insert user or registared user data

            $query = "INSERT INTO user_info(name,email,password,verify_token)
            VALUES('$name','$email','$password','$verify_token')";

            $query_run = mysqli_query($con,$query);

         if($query_run){

            smtp_mailer($email,$subject,$verify_token);

            $_SESSION["status"] = "Registration successful!Please verify your email address";

            header("location:registration.php");

         }else{

            $_SESSION["status"] = "Registration failed!";

            header("location:registration.php");
         }
    }
}

?>

