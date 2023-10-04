<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>

<section>
    <div id="menu">
        <ul>
            <div class="row">
                <div class="col-xl-6">

                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="dashboard.php">Dashboard</a>
                    </li>

                    <?php if(!isset($_SESSION["authenticated"])): ?>
                    <li>
                        <a href="registration.php">Register</a>
                    </li>
                    <?php endif ?>

                </div>
    
                <div class="col-xl-6 link-2">

                    <?php if(!isset($_SESSION["authenticated"])): ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <?php endif ?>

                    <?php if(isset($_SESSION["authenticated"])): ?>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php endif ?>

                </div>
            </div>
        </ul>
    </div>
</section>