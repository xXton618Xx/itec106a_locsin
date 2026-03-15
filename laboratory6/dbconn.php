<?php 
$server = "localhost";
$user = "root";
$pass = "";
$name = "clinic_db";
$conn = new mysqli($server, $user, $pass, $name);
if ($conn->connect_error) {
  die("Connection Failed" . $conn->connect_error);
}
?>