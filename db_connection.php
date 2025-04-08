<?php
$host = "localhost"; 
$username = "root";  
$password = "";     
$database = "bicak";  

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Ne može se povezati: " . mysqli_connect_error());
}


?>
