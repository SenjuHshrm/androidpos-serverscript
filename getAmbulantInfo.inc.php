<?php
if(isset($_GET['info'])){
  $ReqData = $_GET['info'];
  $result = array();
  $result = fetchInfo(explode(" ",$ReqData));
  echo json_encode($result);
}

function fetchInfo($info){
  include 'config.inc.php';
  $xrRes = array();
  $sql = 'CALL POS_fetchAmbInfo(:firstname,:lastname)';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':firstname', $info[0], PDO::PARAM_STR);
  $stmt->bindParam(':lastname', $info[1], PDO::PARAM_STR);
  $stmt->execute();
  while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $xrRes['AMB_RES'][] = $res;
  }
  return $xrRes;
}

?>
