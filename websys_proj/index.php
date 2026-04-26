<?php 
session_start();
if (isset($_SESSION['account_id'])) {
  header("Location: dashboard.php");
  exit();
}
require_once "auth.php";
$auth = new authenticate();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $acctid = trim($_POST["acctid"]);
  $pass = $_POST["psswd"];
  $result = $auth->login($acctid, $pass);
  if ($result["success"]) {
    if ($_SESSION['role'] === "admin") {
      header("Location: admin_dashboard.php");
    } else {
      header("Location: dashboard.php");
    }
    exit();
  } else {
    echo "<script>alert('" . $result['message'] . "');</script>";
  }
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
  <body class=bodylogin>
    <div class="mainForm">
      <div class="loginForm">
        <h2>Login Here</h2>
        <form method="post">
          <label for="accid">Account ID</label><br>
          <input type="text" name="acctid" required><br>
          <label for="pass">Password</label><br>
          <input type="password" name="psswd"><br>
          <button type="submit">Log-in</button>
        </form>
        Click
        <a href="register.php">here</a>
        to register
      </div>
    </div>
  </body>
</html>