<?php
  $servername = "192.168.143.217";
  $username = "it_admin_pylon";
  $password = "2014adamistrative2015";
  $dbname = "market_db";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      die("OOPs something went wrong");
  }
?>
