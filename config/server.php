<?php
session_start();

error_reporting(0);
$errors = array(); 

include("db.php");

// REGISTER USER
if(isset($_POST['signup'])) 
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
  
    if($password != $cpassword) 
    {
        array_push($errors, "The two passwords do not match");
    }

    if(strlen($username) < 5)
    {
        array_push($errors, "Username must be at least 5 characters!");
    }

    if(strlen($username) > 20)
    {
        array_push($errors, "Username can be up to 20 characters!");
    }

    if(strlen($password) < 6 || strlen($cpassword) < 6)
    {
        array_push($errors, "Password must be at least 6 characters long!");
    }

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user) 
    { 
        if ($user['email'] === $email) 
        {
            array_push($errors, "E-mail already exists");
        }
    }

    if (count($errors) == 0) 
    {
        $hash_password = md5($password);

        $query = "INSERT INTO users (username, email, password) 
              VALUES('$username', '$email', '$hash_password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        header('location: index.php');
    }
}


// LOGIN USER
if (isset($_POST['login'])) 
{
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (count($errors) == 0) 
    {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) 
        {
            $_SESSION['email'] = $email;
            header('location: index.php');
        }

        else 
        {
            array_push($errors, "Wrong username/password combination");
        }
    }

}






?>