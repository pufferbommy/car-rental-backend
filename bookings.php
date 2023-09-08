<?php
  require_once("./db.php");

  $conn = connect();

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uID = $_GET['uID'];
    
    try {
      $query = "SELECT * FROM booking LEFT JOIN user ON booking.uID = user.uID LEFT JOIN cars ON booking.cID = cars.cID WHERE booking.uID = :uID ORDER BY booking.uDateFrom DESC";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':uID', $uID, PDO::PARAM_STR);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($rows);
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);

    $bID = uniqid();
    $uID = $data['uID'];
    $cID = $data['cID'];
    $uDateFrom = $data['uDateFrom'];
    $uDateTo = $data['uDateTo'];
    
    try {
      $query = "INSERT INTO booking (bID, uID, cID, uDateFrom, uDateTo) VALUES (:bID, :uID, :cID, :uDateFrom, :uDateTo)";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':bID', $bID, PDO::PARAM_STR);
      $stmt->bindParam(':uID', $uID, PDO::PARAM_STR);
      $stmt->bindParam(':cID', $cID, PDO::PARAM_STR);
      $stmt->bindParam(':uDateFrom', $uDateFrom, PDO::PARAM_STR);
      $stmt->bindParam(':uDateTo', $uDateTo, PDO::PARAM_STR);
      $stmt->execute();
      echo json_encode($stmt->rowCount() > 0);
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $bID = $_GET['bID'];
    
    try {
      $query = "DELETE FROM booking WHERE bID = :bID";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':bID', $bID, PDO::PARAM_STR);
      $stmt->execute();
      echo json_encode($stmt->rowCount() > 0);
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  }
?>