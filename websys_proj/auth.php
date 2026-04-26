<?php require_once "database.php";

class authenticate {
  private $conn;
  public function __construct() {
    $db = new database();
    $this->conn = $db->connect();
  }

  public function register($id, $fname, $lname, $role, $pass) {
    $hashpass = md5($pass);
    $stmt = $this->conn->prepare("INSERT INTO user_information VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $fname, $lname, $role, $hashpass);
    if ($stmt->execute()) {
      return ['success' => true, 'message' => 'Registration successful. You can now login'];
    } else {
      return ['success' => false, 'message' => 'Registration Failed. Try again'];
    }
  }

  public function login($account, $password) {
    $stmt = $this->conn->prepare("SELECT account_id, company_role, password FROM user_information where account_id=?");
    $stmt->bind_param("s", $account);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
      return ["success" => false, "message" => "Invalid account ID or password"];
    }
    $user = $res->fetch_assoc();
    if (md5($password) == $user['password']) {
      session_regenerate_id(true);
      $_SESSION["account_id"] = $user["account_id"];
      $_SESSION["role"] = $user["company_role"];
      return ["success" => true, "message" => "Login OK"];
    } else {
      return ["success" => false, "message" => "Invalid account ID or password"];
    }
  }

  public function count_rows() {
    $res = $this->conn->query("SELECT COUNT(*) AS count FROM user_information")->fetch_assoc();
    return $res["count"];
  }

  public function last_row() {
    $stmt = $this->conn->query("SELECT COALESCE(account_id, 'IT_ACC_0000') as last_row FROM user_information ORDER BY account_id DESC LIMIT 1");
    $res = $stmt->fetch_assoc();
    return $res["last_row"] ?? "IT_ACC_0000";
  }

  public function display_table() {
    $stmt = $this->conn->query("SELECT * FROM user_information");
    if ($stmt->num_rows == 0) {
      echo "No records found";
    } else {
      while ($row = $stmt->fetch_assoc()) {
        echo "<tr>";
        echo "<td>$row[account_id]</td>";
        echo "<td>$row[first_name]</td>";
        echo "<td>$row[surname]</td>";
        echo "<td>$row[company_role]</td>";
        echo "<td>$row[password]</td>";
        echo "</tr>";
      }
    }
  }
}
?>