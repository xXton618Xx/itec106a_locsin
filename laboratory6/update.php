<?php include "dbconn.php";
$id = $_GET['id'];
$row = $conn->query("SELECT * FROM appointments WHERE appointment_id=$id")->fetch_assoc();

// UPDATE Protocol, modify data from database, display back to table via READ.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $state = $conn->prepare("UPDATE appointments SET
    fullname=?, email=?, contact=?, date=?, time=?, department=?, type=?, note=?, status=?
    WHERE appointment_id=?");
  $state->bind_param("sssssssssi", 
    $_POST["name"],     $_POST["email"],
    $_POST["contact"],  $_POST["date"],
    $_POST["time"],     $_POST["dept"],
    $_POST["type"],     $_POST["notes"],
    $_POST["status"],   $id
  );
  $state->execute();
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
  </head>
  <body>
    <header class="header">
      Edit Appointment Information
    </header>
    <div class="displayContent centerTable">
      <table class="formTable">
        <form method="post">
          <tr>
            <td><label for="fullname">Full Name</label></td>
            <td class="input"><input type="text" name="name" value="<?= $row['fullname'] ?>" required></td>
          </tr>
          <tr>
            <td><label for="email">Email Address</label></td>
            <td class="input"><input type="text" name="email" value="<?= $row['email'] ?>" required></td>
          </tr>
          <tr>
            <td><label for="contact">Contact No.</label></td>
            <td class="input"><input type="tel" name="contact" value="<?= $row['contact'] ?>" required></tr>
          <tr>
            <td><label for="date">Appoint Date</label></td>
            <td class="input"><input type="date" name="date" value="<?= $row['date'] ?>" required></td>
          </tr>
          <tr>
            <td><label for="time">Appoint Time</label></td>
            <td class="input"><input type="time" name="time" value="<?= $row['time'] ?>" required></td>
          </tr>
          <tr>
            <td><label for="department">Department</label></td>
            <td class="input">
              <select name="dept" class="department" value="<?= $row['department'] ?>" required>
                <option value="Accounting">Accounting</option>
                <option value="Finance">Finance</option>
                <option value="Marketing">Marketing</option>
                <option value="Auditing">Auditing</option>
                <option value="Others">Others</option>
              </select>
            </td>
          </tr>
          <tr>
            <td ><label for="type">Appoint Type</label></td>
            <td class="input">
              <select name="type" class="department" value="<?= $row['type'] ?>" required>
                <option value="Check-Up">Check-Up</option>
                <option value="Examination">Examination</option>
                <option value="Asisstance">Asisstance</option>
                <option value="Medicine">Medicine</option>
                <option value="Others">Others</option>
              </select>
            </td>
          </tr>
          <tr>
            <td><label for="note">Notes</label></td>
            <td><textarea name="notes" class="notes"  ><?= $row['note'] ?></textarea></td>
          </tr>
          <tr>
            <td><label for="Status">Status</label></td>
            <td class="input">
              <select name="status" class="department" value="<?= $row['status'] ?>" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            </td>
          </tr>
          <tr>
            <td><button type="submit">Submit</button></td>
          </tr>
        </form>
      </table>
    </div>
  </body>
</html>