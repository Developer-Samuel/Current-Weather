<?php

error_reporting(0);

require 'config/logincheck.php';
require 'config/db.php';

if(array_key_exists('submit', $_GET))
{
    if(!$_GET['city'])
    {
        $error = "<b>Your input field is empty.</b>";
    }

    if($_GET['city'])
    {
        $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . 
        $_GET['city'] . "&appid=8900e6009dc60cc4da04ae2c718b2515");
        
        $weatherArray = json_decode($apiData, true);

        $country = $weatherArray['sys']['country'];
        $city = $weatherArray['name'];
        $tempCelsius = intval($weatherArray['main']['temp'] - 273.15);
        $weatherCondition = $weatherArray['weather']['0']['description'];
        $pictogram = $weatherArray['weather']['0']['icon'];

        $imageData = "http://openweathermap.org/img/w/" . $pictogram . ".png";
        
        //print_r($weatherArray);

        if($weatherArray == '')
        {
            $error = "<b>This city has not been found</b>";
            
        }

        else
        {
            $weather = "<img class='pictogram' src='". $imageData . "'>";
            $weather .= "<div class='city-village'><b>City / Village: </b>" . $city . "<br></div>";
            $weather .= "<div class='country'><b>Country: </b>" . $country . "<br></div>";
            $weather .= "<b>Degrees Celsius: </b>" . $tempCelsius . " &deg;C<br>";
            $weather .= "<b>Weather Condition: </b>" . $weatherCondition . "<br>";
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
            <div class="container">
            <h1>Search for weather</h1>
            <div class="add-city-search-weather"><a href="add_city.php">Add City</a></div>
            <div class="logout"><a href="logout.php">Logout</a></div>
            <form class="form-weather" action="" method="GET">
                
                <!--<p><label for="city">Enter the city / village name</label></p>
                <p><input type="text" name="city" id="city" placeholder="City / Village"></p>-->

                <p id="p-choose-city">Choose a city<?php echo $username;?></p>
                <select name="city" class="city">
                    <?php
                        $data = "SELECT *FROM cities";

                        if($cities = mysqli_query($db, $data))
                        {
                            while($cityName = mysqli_fetch_array($cities)) 
                            {
                                echo "<option>" . $cityName['city'] . "</option>";
                            }
                            mysqli_free_result($cities);
                        }
                    ?>
                </select>

                <input type="submit" name="submit" value="Submit">
                <div class="output">
                    <?php

                        if($weather)
                        {
                            echo '<div class="alert alert-success" role="alert">
                            ' . $weather . '
                            </div>';
                        }
                        if($error)
                        {
                            echo '<div class="alert alert-danger" role="alert">
                            ' . $error .'
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