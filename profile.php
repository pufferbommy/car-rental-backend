<?php
  require_once("./db.php");

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $conn = connect();

    $uID = $_GET['uID'];
    
    try {
      $query = "SELECT uName FROM user WHERE uID = :uID";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':uID', $uID, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch();
      echo json_encode($row['uName']);
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  }
?>