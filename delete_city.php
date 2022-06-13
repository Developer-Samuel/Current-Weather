<?php

error_reporting(0);

require 'config/logincheck.php';
require 'config/db.php';

?>


<!doctype html>
<html lang="en">
<?php
        include("inc/head.php");
    ?>
    <body>
        <div class="index-body">
            <div class="container">
                
            <h1>Delete Cities / Villages</h1>
            <div class="add-city-search-weather"><a href="index.php">Search for Weather</a></div>
            <div class="add-city"><a href="add_city.php">Add City</a></div>
            <div class="logout"><a href="logout.php">Logout</a></div>

            	
                
                    <?php

                    // select all users
                    $data = "SELECT * FROM cities";

                    if($cities = mysqli_query($db, $data))
                    {
                        if(mysqli_num_rows($cities) > 0)
                        {
                            echo "<table class='table-cities'>
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>City</th>
                                      </tr>
                                    </thead>
                                    <tbody>";

                            while($city = mysqli_fetch_array($cities)) 
                            {
                                echo "<tr>";
                                echo "<td>" . $city['id'] . "</td>";
                                echo "<td>" . $city['city'] . "</td>";
                                echo "<td><a href=\"delete.php?id=$city[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";	
                                echo "</tr>";
                            }
                            echo "</tbody>
                            </table>";
                            mysqli_free_result($cities);
                        } 

                        else
                        {
                            echo "<p class='no-records'>No records found.</p>";
                        }
                    }

                    // Close connection
                    mysqli_close($db);
                    ?>

            </div>
        </div>
<?php
    include("inc/footer.php");
?>