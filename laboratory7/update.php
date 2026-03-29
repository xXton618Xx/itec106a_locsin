<?php include "appointments.php";

$appointment = new appointments();
$row = $appointment->exec_query("SELECT * FROM appointments WHERE id=?");
if (!$row) {
  die("No rows selected! returning to index");
  header("Location: index.php");
  exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $appointment->update(
    $_POST["name"],     $_POST["mail"],
    $_POST["contact"],  $_POST["date"],
    $_POST["time"],     $_POST["dept"],
    $_POST["type"],     $_POST["note"],
    $_POST["status"],   $id
  );
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <h1>Update Appointments</h1>
    <form method="post">
      <?php # nakakatamad kaya ganto na lang haha, ultimate lazy dev
        $label = ["Full Name", "Email Address", "Contact Number", "Appoint Date", 
          "Appoint Time", "Department", "Appoint Type", "Status"];
        $name = ["name",  "mail", "contact", "date", "time", "dept", "type", "status"];
        $row_name = ["name",  "email", "contact", "date", "time", "department", "type", "status"];
        $type = ["text", "text", "tel", "date", "time", "text", "text", "text"];
        for ($i = 0; $i < count($name); $i++) {
          $val = $row[$row_name[$i]];
          echo"
            <label for=$name[$i]>$label[$i]</label>
            <input type=$type[$i] name=$name[$i] value=$val required><br>
          ";
        }
      ?>
      <label for="note">Additional Notes</label>
      <textarea name="note"><?= $row["status"] ?></textarea><br>
      <button type="submit">Submit</button>
    </form>
  </body>
</html>