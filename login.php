<?php

error_reporting(0);

require 'config/server.php';

?>


<!doctype html>
<html lang="en">
    <?php
        include("inc/head.php");
    ?>

    <body>

        <div class="login-body">
        <?php require 'config/errors.php'; ?>
            <div class="container">
                <h1 id="h1-logreg">LOGIN</h1>
                <form class="form-login" action="" method="POST">
                    <p><label for="email">Email</label></p>
                    <p><input type="text" name="email" id="email" placeholder="example@gmail.com" required></p>
                    <br>
                    <p><label for="password">Password</label></p>
                    <p><input type="password" name="password" id="password" placeholder="********" required></p>

                    <input type="submit" name="login" value="Login">

                    <a class="small" href="signup.php">Create an Account!</a>
                </form>
            </div>
        </div>
        
<?php
    include("inc/footer.php");
?>