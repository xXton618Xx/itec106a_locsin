<?php
session_start();
if (isset($_SESSION['account_id'])) {
  header("Location: dashboard.php");
  exit();
}
require_once "auth.php";
$auth = new authenticate();
$count = $auth->count_rows();
$lrow = $auth->last_row();
$success = false;
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['accId'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $role = $_POST['role'];
  $pass = $_POST['pass'];
  $res = $auth->register($id, $fname, $sname, $role, $pass);
  $message = $res['message'];
  $success = $res['success'];
}
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register User</title>
  </head>
  <body class=register>
    <div class="mainRegister">
      <fieldset class=regFieldset>
        <legend class=regLegend>User Registration</legend>
        <div class="regContent">
          <div class="mainRegForm">
            <form method="post">
              <input type="hidden" id="count" value="<?= $count; ?>">
              <input type="hidden" id="lastrow" value="<?= $lrow; ?>">
              <table class="regForm">
                <tr>
                  <td><label for="aID">Account ID</label></td>
                  <td><input type="text" name="accId" id="accID" readonly></td>
                </tr>
                <tr>
                  <td><label for="fname">First Name</label></td>
                  <td><input type="text" name="fname" required></td>
                </tr>
                <tr>
                  <td><label for="sname">Surname</label></td>
                  <td><input type="text" name="sname" required></td>
                </tr>
                <tr>
                  <td><label for="role">Company Role</label></td>
                  <td>
                    <select name="role">
                      <option value="employee">Employee</option>
                      <option value="admin">Administrator</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="ipass">Password</label></td>
                  <td><input type="password" id="password" required></td>
                </tr>
                <tr>
                  <td><label for="fpass">Confirm Password</label></td>
                  <td><input type="password" name="pass" id="confPass" required></td>
                </tr>
                <tr>
                  <td><button type="submit" id="submit" disabled>Register</button></td>
                  <td><button type="reset">Reset Inputs</button></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="passCondition">
            <h3>Password Requirements</h3>
            <ul>
              <li id="isEight">between 8 to 20 characters</li>
              <li id="hasNums">has numbers</li>
              <li id="hasChars">has special characters</li>
            </ul>
            Click <a href="index.php">here</a> to login instead.
          </div>
        </div>
      </fieldset>
    </div>
    <div class="modalWindow" id="modalWindow" style="display: <?= $success ? 'flex' : 'none'; ?>;">
      <div class="modalContent">
        <p><?= $message; ?></p>
        <p>use this Account ID to log in</p>
        Account ID: <span id="accountLogin"></span>
        <div class="login">
          <a href="index.php" id="loginRedir">Log In</a>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
    <script>
      function generateAccountId(tableCount, lastRow) {
        let initString = "IT_ACC_";
        let value = 4 - tableCount.toString().length;
        let zeroes = "0".repeat(value) + (lastRow + 1);
        return (initString + zeroes);
      }
      let accountId = document.getElementById("accID")
      let accountLogin = document.getElementById("accountLogin")
      let count = document.getElementById("count");
      let lrow = document.getElementById("lastrow").value;
      let lastRow = lrow.slice(-4);
      let newId = generateAccountId(count.value, parseInt(lastRow))
      accountId.value = newId ;
      accountLogin.textContent = newId;
      console.log(newId);
    </script>
  </body>
</html>