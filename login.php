<?php include_once "header.php"; ?> 
<?php 

if(isset($_SESSION["authenticated"])){

    $_SESSION["status"] = "You Are Already Loggedin.!";
    header("location:dashboard.php");
    exit(0);
}

?>


<div class="signup-form">

    <div class="status">
        <?php
        if(isset($_SESSION["status"]))
		{
		?>
		<div class="alert">
            <h3> <?php echo $_SESSION["status"] ; ?> </h3>
		</div>
		<?php	
            unset($_SESSION["status"]);
        }
        ?>
    </div>

    <form action="submit_login.php" method="post">
		<h2>Login</h2>
		<p>Enter your email id and password</p>
		<hr>
 
		<div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" >
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" >
        </div>

		<div class="form-group">
            <div class="row">
                <div class="col-md-6">
                <button type="submit" name="submit_login" class="btn btn-primary btn-lg btn-block">Log in</button>
                </div>
                <div class="col-md-6 forgot">
                    <a href="password_reset.php">Forgot Your Password?</a>
                </div>
            </div>

        </div>
        
    </form>

	<div class="hint-text">Create a account? <a href="registration.php">Sign up</a></div>
</div>

<?php include_once "footer.php"; ?> 