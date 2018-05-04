<?php
if(isset($_GET['info'])){
	$sqlAmb1 = "SELECT UPPER(CONCAT(firstset.firstname,' ',firstset.lastname)) AS 'Ambulant Owner',
		secondset.nature_or_business AS 'Business' FROM market_db.customer AS firstset
		LEFT JOIN tenant AS secondset ON firstset.customer_id = secondset.fk_customer_id LEFT JOIN
		stall AS thirdset ON secondset.fk_customer_id = thirdset.tenant_id
		WHERE firstset.firstname = :firstname";

	$sqlAmb2 = "SELECT UPPER(CONCAT(firstset.firstname,' ',firstset.lastname)) AS 'Ambulant Owner',
		secondset.nature_or_business AS 'Business' FROM market_db.customer AS firstset
		LEFT JOIN tenant AS secondset ON firstset.customer_id = secondset.fk_customer_id LEFT JOIN
		stall AS thirdset ON secondset.fk_customer_id = thirdset.tenant_id
		WHERE firstset.firstname = :firstname AND firstset.lastname = :lastname";

  $ReqData = $_GET['info'];
  $result = array();
	$response = array();
	$result = explode(" ",$ReqData);
	if(count($result) == 1){
		$response = fetchInfo($result, $sqlAmb1);
	}else{
		$response = fetchInfo($result, $sqlAmb2);
	}
  echo json_encode($response);
}

	function fetchInfo($info,$sqlQuery){
	  include 'config.inc.php';
	  $xrRes = array();
	  // $stmt = $conn->prepare($sql);
	  // $stmt->bindParam(':firstname', $info[0], PDO::PARAM_STR);
	  // $stmt->bindParam(':lastname', $info[1], PDO::PARAM_STR);
		if(count($info) == 1){
			$stmt = $conn->prepare($sqlQuery);
		  $stmt->bindParam(':firstname', $info[0], PDO::PARAM_STR);
		}else if(count($info) == 2){
			$stmt = $conn->prepare($sqlQuery);
		  $stmt->bindParam(':firstname', $info[0], PDO::PARAM_STR);
		  $stmt->bindParam(':lastname', $info[1], PDO::PARAM_STR);
		}
	  $stmt->execute();
	  while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
	    $xrRes['AMB_RES'][] = $res;
	  }
	  return $xrRes;
	}

?>
