<?php include "dbconn.php";

class appointments {
  private $conn;

  # Initialize Database
  public function __construct() {
    $db = new dbconn();
    $this->conn = $db->connect();
  }

  # CREATE function, INSERT a new row to table
  public function create($name, $mail, $cont, $date, $time, $dept, $type, $note) {
    $state = $this->conn->prepare("INSERT INTO appointments 
      (name, email, contact, date, time, department, type, note) VALUES
      (?, ?, ?, ?, ?, ?, ?, ?)");
    $state->bind_param("ssssssss", $name, $mail, $cont, $date, $time, $dept, $type, $note);
    $state->execute();
    header("Location: index.php");
    exit();
  }

  # READ function, SELECT to all rows
  public function read() {
    $result = $this->conn->query("SELECT * FROM appointments ORDER BY date, time");
    $columns = ["name", "email", "contact", "date", "time", "department", "type", "note", "status"];
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      $id = $row['id'];
      foreach($columns as $i) { # shorthanded <td> expression to lessen line consumption
        echo "<td>$row[$i]</td>";
      }
      echo "
        <td>
          <a href=update.php?id=$id>Update</a>
          <a href=delete.php?id=$id>Delete</a>
        </td>
      ";
      echo "</tr>";
    }
  }

  # UPDATE function, update row component
  public function update($name, $mail, $cont, $date, $time, $dept, $type, $note, $status, $id) {
    $state = $this->conn->prepare("UPDATE appointments SET
      name=?, email=?, contact=?, date=?, time=?, department=?, type=?, note=?, status=?
      WHERE id=?");
    $state->bind_param("sssssssssi", $name, $mail, $cont, $date, $time, $dept, $type, $note, $status, $id);
    $state->execute();
    header("Location: index.php");
    exit();
  }

  # DELETE function, will use exec_query for delete instead to make use of $id validation
  public function delete($id) {
    $state = $this->conn->prepare("DELETE FROM appointments id=?");
    $state->bind_param("i", $id);
    $state->execute();
  }

  # SQL Query Specific function for specific id, OK for SELECT and DELETE
  public function exec_query($query) {
    $id = $_GET["id"] ?? 0;
    if ($id <= 0) { 
      die("Invalid Appointment");
    }
    $state = $this->conn->prepare($query);
    $state->bind_param("i", $id);
    $state->execute();
    if (preg_match("/SELECT/i", $query)){
      return $state->get_result()->fetch_assoc();
    } else {
      header("Location: index.php");
      exit();
    }
  }
}
?>