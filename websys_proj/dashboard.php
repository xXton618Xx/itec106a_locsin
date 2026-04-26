<?php 
session_start();
if (!isset($_SESSION['account_id'])) {
  header("Location: index.php");
  exit();
}
if ($_SESSION['role'] === "admin") {
  header("Location: admin_dashboard.php");
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
    <div class="header">
      
    </div>
    <div class="mainContent">
      <div class="sidebar"></div>
      <div class="centerContent">
        <div class=greet>Welcome, <?= $_SESSION["account_id"]?>!</div>
        <a href="logout.php">Logout Here</a>
      </div>
    </div>
  </body>
</html>