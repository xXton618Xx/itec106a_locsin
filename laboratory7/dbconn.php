<?php
class dbconn {
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $name = "clinic_database";
  private $conn;

  public function connect() {
    $this->conn = new mysqli(
      $this->host,
      $this->user,
      $this->pass,
      $this->name
    );
    if ($this->conn->connect_error) {
      die("Connection Failed" . $this->conn->connect_error);
    }
    return $this->conn;
  }
}
?>