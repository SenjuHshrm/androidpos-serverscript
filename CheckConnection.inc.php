<?php
  try{
    include 'config.inc.php';
    $response = "";
    $sql = "SHOW TABLES FROM market_db";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $response = "ok";
  }catch(Exception $e){
    $response = "dbError";
  }
  echo $response;
?>
