<html>
<head>
    <title> Il-Lengan </title>
    <link rel="icon" type="image/png" href="./assets/media/logo.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login/style.css')?>">     
    <link rel="stylesheet" type="text/css" href="<?= framework_url().'bootstrap-native/bootstrap.min.css'?>">

</head>
    <body>
        <div class="form-box">
            <span><?php 
            if(isset($err)){
                echo $err;
            }?></span>
            <img src="<?php echo base_url('/assets/media/logo.png')?>" class="logo">
            <form method="post" action="<?= site_url("verify"); ?>">
                    <p>Username</p>
                        <input type="text" name="username" placeholder="Enter Username" required>
                    <p>Password</p>
                        <input type="password" name="password" placeholder="Enter Password" required>
                    <br><br>
                        <input type="submit" name="submit" value="Log In">   
            </form>
        </div>
    </body>
</html>
