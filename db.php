<?php
  function connect(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "final64125842";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }
?>