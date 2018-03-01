<?php
  $servername = "192.168.143.24";
  $username = "it_admin_pylon";
  $password = "unknown192";
  $dbname = "market_db";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      die("OOPs something went wrong");
  }

?>
