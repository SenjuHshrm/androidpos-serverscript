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
    $sql = "SELECT s.unit_no AS 'Stall No.', UPPER(CONCAT(c.firstname,' ',c.lastname)) AS 'Name',
						t.nature_or_business AS 'Business' FROM tenant AS t LEFT JOIN customer AS c ON t.fk_customer_id = c.customer_id
						LEFT JOIN stall AS s ON s.tenant_id = t.tenant_id WHERE s.unit_no = :stallNo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':stallNo', $info, PDO::PARAM_STR);
    $stmt->execute();
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
      $xrRes['STALL_RES'][] = $res;
    }
    return $xrRes;
  }

?>
