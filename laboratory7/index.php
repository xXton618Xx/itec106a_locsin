<?php include "appointments.php";

$appointment = new appointments();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $appointment->create(
    $_POST["name"],     $_POST["mail"],
    $_POST["contact"],  $_POST["date"],
    $_POST["time"],     $_POST["dept"],
    $_POST["type"],     $_POST["note"]
  );
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      table { border-collapse: collapse; }
    </style>
    <title>CRUD OOP</title>
  </head>
  <body>
    <h1>Appointments</h1>
    <table border=1>
      <tr>
        <?php # nakakatamad kaya ganto na lang haha, ganun den naman
          $header = ["Full Name", "Email Add.", "Contact", "Date", "Time", "Department", 
            "Appoint Type", "Notes", "Status", "Options"];
          foreach($header as $i) {
            echo "<td>$i</td>";
          }
        ?>
      </tr>
      <?php $appointment->read(); ?>
    </table>
    <br>
    <form method="post">
      <?php # nakakatamad kaya ganto na lang haha
        $label = ["Full Name", "Email Address", "Contact Number", "Appoint Date", 
          "Appoint Time", "Department", "Appoint Type"];
        $name = ["name",  "mail", "contact", "date", "time", "dept", "type"];
        $type = ["text", "text", "tel", "date", "time", "text", "text",];
        for ($i = 0; $i < count($name); $i++) {
          echo"
            <label for=$name[$i]>$label[$i]</label>
            <input type=$type[$i] name=$name[$i] required><br>
          ";
        }
      ?>
      <label for="note">Additional Notes</label>
      <textarea name="note"></textarea><br>
      <button type="submit">Submit</button>
    </form>
  </body>
</html>