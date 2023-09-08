<?php
  require_once("./db.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);

    if ($data !== null) {
      $conn = connect();

      $username = $data['username'];
      $password = $data['password'];
      
      try {
        $query = "SELECT * FROM user WHERE uTelephone = :username AND uPassword = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row['uID']);
      } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode($e);
      }
    } else {
      http_response_code(400);
      echo "Invalid JSON data";
    }
  }
?>