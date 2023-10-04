<?php include_once "header.php"; ?> 

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
           
    <form action="submit_registration.php" method="post">

		<h2>Register</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
 
        <div class="form-group">
        	<input type="text" class="form-control" name="name" id="name" placeholder="name" required>
        </div>
		<div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>

		<div class="form-group">
            <button type="submit" name="submit_registraion" class="btn btn-primary btn-lg btn-block">Sign Up</button>
        </div>
     
    </form>
	<div class="hint-text">Already have an account? <a href="login.php">Sign in</a></div>
</div>	

<?php include_once "footer.php"; ?> 