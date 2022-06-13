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

        <div class="signup-body">
        <?php require 'config/errors.php'; ?>
            <div class="container">
                <h1 id="h1-logreg">SIGN UP</h1>
                <form class="form-signup" action="" method="POST">
                    
                    <p><label for="username">Username</label></p>
                    <p><input type="username" name="username" id="username" placeholder="Christian7" required></p>
                    <br>
                    <p><label for="email">Email</label></p>
                    <p><input type="email" name="email" id="email" placeholder="example@gmail.com" required></p>
                    <br>
                    <p><label for="password">Password</label></p>
                    <p><input type="password" name="password" id="password" placeholder="********" required></p>
                    <br>
                    <p><label for="cpassword">Confirm Password</label></p>
                    <p><input type="password" name="cpassword" id="cpassword" placeholder="********" required></p>
                    <input type="submit" name="signup" value="Register">
                    <br>
                    <a class="small" href="login.php">Already have an account? Login!</a>

                    
                </form>
            </div>
        </div>
        
<?php
    include("inc/footer.php");
?>