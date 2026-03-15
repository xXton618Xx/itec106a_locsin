<?php include "dbconn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // CREATE Protocol, insert data to database;
  $state = $conn->prepare("INSERT INTO appointments 
    (fullname, email, contact, date, time, department, type, note)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $state->bind_param("ssssssss", 
    $_POST["name"],     $_POST["email"],
    $_POST["contact"],  $_POST["date"],
    $_POST["time"],     $_POST["dept"],
    $_POST["type"],     $_POST["notes"]
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
    <title>CRUD</title>
  </head>
  <body>
    <header class="header">
      Appointment Setting and Display
    </header>
    <main class="mainContent">
      <div class="displayContent">
        <table class="displayTable">
          <tr class="tableHeader">
            <td>Full Name</td>
            <td>Email Address</td>
            <td>Contact No.</td>
            <td>Date</td>
            <td>Time</td>
            <td>Department</td>
            <td>Type</td>
            <td>Notes</td>
            <td>Options</td>
            <td>Status</td>
          </tr>
          <?php 
          // READ protocol, display data to table.
          $result = $conn->query("SELECT * FROM appointments ORDER BY date, time");
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td><?= $row["fullname"]; ?></td>
              <td><?= $row["email"]; ?></td>
              <td><?= $row["contact"]; ?></td>
              <td><?= $row["date"]; ?></td>
              <td><?= $row["time"]; ?></td>
              <td><?= $row["department"]; ?></td>
              <td><?= $row["type"]; ?></td>
              <td><?= $row["note"]; ?></td>
              <td>
                <a href="update.php?id=<?= $row['appointment_id'] ?>">Update</a>
                <a href="delete.php?id=<?= $row['appointment_id'] ?>">Delete</a>
              </td>
              <td><?= $row["status"]; ?></td>
            </tr>
            <?php }} ?>
        </table>
      </div>
      <div class="displayContent centerTable">
        <table class="formTable">
          <form method="post">
            <tr>
              <td><label for="fullname">Full Name</label></td>
              <td class="input"><input type="text" name="name" required></td>
            </tr>
            <tr>
              <td><label for="email">Email Address</label></td>
              <td class="input"><input type="text" name="email" required></td>
            </tr>
            <tr>
              <td><label for="contact">Contact No.</label></td>
              <td class="input"><input type="tel" name="contact" required></tr>
            <tr>
              <td><label for="date">Appoint Date</label></td>
              <td class="input"><input type="date" name="date" required></td>
            </tr>
            <tr>
              <td><label for="time">Appoint Time</label></td>
              <td class="input"><input type="time" name="time" required></td>
            </tr>
            <tr>
              <td><label for="department">Department</label></td>
              <td class="input">
                <select name="dept" class="department" required>
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
                <select name="type" class="department" required>
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
              <td><textarea name="notes" class="notes"></textarea></td>
            </tr>
            <tr>
              <td><button type="submit">Submit</button></td>
              <td><button type="reset">Reset</button></td>
            </tr>
            <input type="hidden" name="status" value="Pending">
          </form>
        </table>
      </div>
    </main>
  </body>
</html>