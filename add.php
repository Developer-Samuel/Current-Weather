<?php

error_reporting(0);
$errors = array(); 

require './config/db.php';

// ADD CITY
if(isset($_POST['add'])) 
{
    $city = mysqli_real_escape_string($db, $_POST['city']);

    $city_check_query = "SELECT * FROM cities WHERE city='$city' LIMIT 1";
    $result = mysqli_query($db, $city_check_query);
    $cityWasAdded = mysqli_fetch_assoc($result);

    if(empty($city))
    {
        array_push($errors, "Your input field is empty.");
    }

}