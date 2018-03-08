<?php
  if(isset($_GET['type'])){
    $type = $_GET['type'];
    $result = array();
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
    $xrRes = array();
    $stmt = $conn->prepare($BusType);
    $stmt->execute();
    // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
      $xrRes['Names'][] = $res;
    }
    return $xrRes;
  }
?>
