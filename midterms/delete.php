<?php
include_once 'dbconn.php';
$id = $_GET['id'];
$conn->query("DELETE FROM appointments WHERE appID=$id");
header("Location: index.php");
?>