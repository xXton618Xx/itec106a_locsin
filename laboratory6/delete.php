<?php include "dbconn.php";
$id = $_GET["id"];
$conn->query("DELETE FROM appointments WHERE appointment_id=$id");
header("Location: index.php");
exit();

?>