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
                    <h5>Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="password_reset_action.php" method="post">
                        <div class="form-group mb-3">
                            <label>Email Adress</label>
                            <input type="email" name="email" value="<?php if(isset($_REQUEST["email"])){echo $_REQUEST["email"];} ?>" class="form-control" placeholder="Enter Email Address"> 
                        </div>
                        <div class="form-group mb-3">
                            <label>New Password</label>
                            <input type="password" name="new_pass" class="form-control" placeholder="Enter New Password"> 
                        </div>
                        <div class="form-group mb-3">
                            <label>Email Adress</label>
                            <input type="password" name="confirm_pass" class="form-control" placeholder="Enter Confirm Password"> 
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="password_update" class="btn btn-primary">Update Password</button>
                            <input type="hidden" name="pass_reset_token"  value="<?php if(isset($_REQUEST["token"])){echo $_REQUEST["token"];} ?>">

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>