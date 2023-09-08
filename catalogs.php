<?php
  require_once("./db.php");

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $conn = connect();

    $brand = $_GET['brand'];
    
    try {
      if($brand == 'All' || $brand == '') {
        $query = "SELECT * FROM cars";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
        return;
      } else {
        $query = "SELECT * FROM cars WHERE cBrand LIKE :cBrand";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cBrand', $brand, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
        return;
      }
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode($e);
    }
  }
?>