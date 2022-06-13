<?php

error_reporting(0);

require 'config/logincheck.php';
require 'add.php';

if(array_key_exists('add', $_POST))
{
    if($_POST['city'])
    {
        $city = $_POST['city'];

        $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . 
        $_POST['city'] . "&appid=8900e6009dc60cc4da04ae2c718b2515");
        
        $weatherArray = json_decode($apiData, true);

        if($weatherArray == '')
        {
            $city_error = "<b>This city does not exist!</b>";
        }

        elseif($cityWasAdded) 
        { 
            $city_error =  "<b>City has already been added</b>";
        }

        else
        {
            $str = mb_convert_case($city, MB_CASE_TITLE, "UTF-8");
            $capitalizeCity = ucfirst($str);

            $query = "INSERT INTO cities (city) 
                  VALUES('$capitalizeCity')";
            mysqli_query($db, $query);
        }
    }
}

?>


<!doctype html>
<html lang="en">
<?php
        include("inc/head.php");
    ?>
    <body>
        <div class="index-body">
        <?php require 'config/errors.php'; ?>
            <div class="container">
            <h1>Add Cities / Villages to SQL</h1>
            <div class="add-city-search-weather"><a href="index.php">Search for Weather</a></div>
            <div class="delete-city"><a href="delete_city.php">Delete City</a></div>
            <div class="logout"><a href="logout.php">Logout</a></div>
            <form class="form-weather" action="" method="POST">
                <p><label for="city">Enter the city / village name</label></p>
                <p><input type="text" name="city" id="city" placeholder="City / Village"></p>
                <input type="submit" name="add" value="ADD">
                
                <div class="output">
                    <?php

                        if($city)
                        {
                            echo '<div class="alert alert-success" role="alert">
                            The ' . $city . ' has been added now!
                            </div>';
                        }

                        if($city_error)
                        {
                            echo '<div class="alert alert-danger" role="alert">
                            ' . $city_error . '
                            </div>';
                        }

                    ?>
                </div>
            </form>
            </div>
        </div>
<?php
    include("inc/footer.php");
?>