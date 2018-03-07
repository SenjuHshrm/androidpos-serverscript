<?php
  header('Content-Type: application/json');
  if(isset($_GET['type'])){
    $type = $_GET['type'];
    $sqlAmb = 'CALL POS_fetchAmbInfo()';
    $sqlSt = 'CALL POS_fetchStallInfo()';
    if($type == "ambulant"){
      $result = fetchInfo($sqlAmb);
    }else if($type == "stall"){
      $result = fetchInfo($sqlSt);
    }
    echo json_encode($result);
  }
  function fetchInfo($BusType){
    include 'config.inc.php';
    $stmt = $conn->prepare($BusType);
    $stmt->execute();
    return $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
?>
