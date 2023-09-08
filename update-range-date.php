<?php
  require_once("./db.php");

  $conn = connect();

  if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $jsonData = file_get_contents('php://input');

    $bID = $_GET['bID'];

    $data = json_decode($jsonData, true);

    $uDateFrom = $data['uDateFrom'];
    $uDateTo = $data['uDateTo'];
    
    try {
      $query = "UPDATE booking SET uDateFrom = :uDateFrom, uDateTo = :uDateTo WHERE bID = :bID";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':bID', $bID, PDO::PARAM_STR);
      $stmt->bindParam(':uDateFrom', $uDateFrom, PDO::PARAM_STR);
      $stmt->bindParam(':uDateTo', $uDateTo, PDO::PARAM_STR);
      $stmt->execute();
      echo json_encode($stmt->rowCount() > 0);
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  }
?>