<?php 

error_reporting(0);

require 'config/logincheck.php';
require 'config/db.php';

$id = $_GET['id'];

$result = mysqli_query($db, "DELETE FROM cities WHERE id=$id");

header("Location: delete_city.php");

?>