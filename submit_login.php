<?php include_once "header.php"; ?> 
<?php include_once "connection_db.php";?>


<?php 

    //data_recive
    if(isset($_REQUEST["submit_login"])){

        //input button blank rekhe kew btn e click korle ey condition
        if(!empty(trim($_REQUEST["email"])) && !empty(trim($_REQUEST["password"]))){//trim means 2i pash theke space dile remove kore dey

            $email    = mysqli_real_escape_string($con,$_REQUEST["email"]); // data reveive or rietrive korar somoy evabe recieve korle kew vul valu dite parbe na 
            $password = mysqli_real_escape_string($con,$_REQUEST["password"]);


            $login_query = "SELECT * FROM user_info WHERE email='$email' AND password='$password' LIMIT 1"; // limit 1 means top-1 data read/show korbe
            $login_query_run = mysqli_query($con,$login_query);

            //any email exits or not eyta cheak korbe
            $count = mysqli_num_rows($login_query_run);

            if($count > 0){
                //email database er vitore thakle ekhane fetch kore 1 ta data anbe

                $row = mysqli_fetch_assoc($login_query_run);
                $db_name_status   = $row["name"];
                $db_email_status  = $row["email"];
                $db_pass_status   = $row["password"];
                $db_verify_status = $row["verify_status"];

                //cheak email verifyed or not 
                if($db_verify_status == 1){

                    $_SESSION["authenticated"] = True;

                    $_SESSION["auth_user"] = [

                        'name' => $db_name_status ,
                        'email'=> $db_email_status,
                        'password' => $db_pass_status
                    ];
                    $_SESSION["status"] = "You Are Loged in Successfully.!";
                    header("location:dashboard.php");
                    exit(0);

                }else{

                    $_SESSION["status"] = "Please Verify Your Email Address To Login.!";
                    header("location:login.php");
                    exit(0);
                }

            }else{

                $_SESSION["status"] = "Invalid Email or Password";
                header("location:login.php");
                exit(0);
            }
            
        }else{

            $_SESSION["status"] = "All Files Are Mendatory";
            header("location:login.php");
            exit(0);
        }
    }

?>

<?php include_once "footer.php"; ?> 