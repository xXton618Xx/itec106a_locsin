<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "locsin"; // the $name is the database name, change it to the name of your createdd database.
$conn = new mysqli($host, $user, $pass, $name);
if ($conn -> connect_error) {
    die("Connection Failed".$conn->connect_error);
}

?>