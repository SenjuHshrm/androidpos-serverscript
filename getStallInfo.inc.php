<?php
  if(isset($_GET['info'])){
    $ReqData = $_GET['info'];
    $result = array();
    $result = fetchInfo($ReqData);
    echo json_encode($result);
  }

  function fetchInfo($info){
    include 'config.inc.php';
    $xrRes = array();
    $sql = 'CALL POS_fetchStallInfo(:info)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':info', $info, PDO::PARAM_STR);
    $stmt->execute();
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
      $xrRes['STALL_RES'][] = $res;
    }
    return $xrRes;
  }

?>
