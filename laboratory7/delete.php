<?php include "appointments.php";
$appointment = new appointments();
$appointment->exec_query("DELETE FROM appointments WHERE id=?");
?>