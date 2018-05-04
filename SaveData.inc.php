<?php
  function SavePaymentData($type,$owner,$business,$payment,$collector){
    include 'config.inc.php';
    $ResponseData = '';
		$CurrDate = date('m/d/Y');
    $UsrId = explode(" ", $collector);
    $CusId = explode(" ", $owner);
    $sql = "INSERT INTO market_db.transaction(fund_id,payment_nature_id,payment_amount,
						user_id,customer_id,effectivity,collector)VALUES(
						1,4011,:Payment,
						(SELECT user_id FROM market_db.user WHERE usr_firstname = :UsrFirst AND usr_lastname = :UsrLast),
						(SELECT customer_id FROM customer AS c LEFT JOIN tenant AS t ON c.customer_id = t.fk_customer_id
							WHERE c.firstname = :CusFirst AND c.lastname = :CusLast AND t.nature_or_business = :Business),
    				:Eff,:CollName)";
		$sql1 = "SELECT transaction_id FROM market_db.transaction ORDER BY transaction_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UsrFirst',$UsrId[0],PDO::PARAM_STR);
    $stmt->bindParam(':UsrLast',$UsrId[1],PDO::PARAM_STR);
    $stmt->bindParam(':CusFirst',$CusId[0],PDO::PARAM_STR);
    $stmt->bindParam(':CusLast',$CusId[1],PDO::PARAM_STR);
		$stmt->bindParam(':Business', $business,PDO::PARAM_STR);
    $stmt->bindParam(':Payment',$payment,PDO::PARAM_STR);
    $stmt->bindParam(':CollName',$collector,PDO::PARAM_STR);
		$stmt->bindParam(':Eff',$CurrDate,PDO::PARAM_STR);
    $stmt->execute();
		$stmt1 = $conn->prepare($sql1);
		$stmt1->execute();
    if($stmt1->rowCount()){
      $result = $stmt1->fetchAll();
      foreach($result as $res){
        $ResponseData = CreateTransactionNumber($res[0]);
      }
    }elseif(!$stmt->rowCount()){
      $ResponseData = 'false';
    }
    return $ResponseData;
  }
  function CreateTransactionNumber($id){
    include 'config.inc.php';
    $res = '';
    $idLen = strlen($id);
    $TRNum = 9 - $idLen;
    $TrnGen = 'M';
    $sql = "UPDATE market_db.transaction SET or_number = :TransactionNum WHERE transaction_id = :transactionId";
    for($x = 0; $x < $TRNum; $x++){
      $TrnGen = $TrnGen . '0';
    }
    $res = $TrnGen . $id;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':TransactionNum',$res,PDO::PARAM_STR);
    $stmt->bindParam(':transactionId',$id,PDO::PARAM_STR);
    $stmt->execute();
    return $res;
  }
?>
