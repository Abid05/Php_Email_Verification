<?php include_once "header.php"; ?> 
<?php



?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 card-box">
            <div class="status">
            <?php
                if(isset($_SESSION["status"]))
                {
                ?>
                <div class="alert">
                    <h3> <?php echo $_SESSION["status"] ; ?> </h3>
                </div>

                <?php	
                    unset($_SESSION["status"]);// unset means refress dewar por cole jabe status 
                }
                ?>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Password Reset</h5>
                </div>
                <div class="card-body">
                    
                    <form action="password_reset_action.php" method="post">
                        <div class="form-group mb-3">
                            <label>Email Adress</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address"> 
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="password_reset_link" class="btn btn-primary">Reset Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>