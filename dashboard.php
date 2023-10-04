
<?php include_once "header.php"; ?> 
<?php include_once "authentication.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-xl-12 card-box">

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
                    <h4>User Dashboard</h4>
                </div>
                <div class="card-body">
                    <h4>Access when you are loged in</h4>
                    <hr>
                    <h5>Name:  <?= $_SESSION["auth_user"] ["name"]?></h5> 
                    <h5>Email: <?= $_SESSION["auth_user"] ["email"]?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

