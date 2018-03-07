<?php
  if(isset($_POST['type'])){
    $xrRes = array();
    $type = $_POST['type'];
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
    // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    while($res = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      $xrRes['Names'][] = $res;
    }
    echo json_encode($xrRes);
  }
?>
