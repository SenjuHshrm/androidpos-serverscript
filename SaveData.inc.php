<?php
  function SavePaymentData($type,$owner,$business,$payment,$collector){
    include 'config.inc.php';
    $ResponseData = '';
    $UsrId = explode(" ", $collector);
    $CusId = explode(" ", $owner);
    $sql = 'CALL POS_SaveTransaction(:UsrFirst,:UsrLast,:CusFirst,:CusLast,:Payment,:CollName)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UsrFirst',$UsrId[0],PDO::PARAM_STR);
    $stmt->bindParam(':UsrLast',$UsrId[1],PDO::PARAM_STR);
    $stmt->bindParam(':CusFirst',$CusId[0],PDO::PARAM_STR);
    $stmt->bindParam(':CusLast',$CusId[1],PDO::PARAM_STR);
    $stmt->bindParam(':Payment',$payment,PDO::PARAM_STR);
    $stmt->bindParam(':CollName',$collector,PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()){
      $result = $stmt->fetchAll();
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
    $sql = 'CALL POS_SaveTransactionNumber(:TransactionNum,:transactionId)';
    for($x = 0; $x < $TRNum; $x++){
      $TrnGen = $TrnGen . '0';
    }
    $res = $TrnGen . $id;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('TransactionNum',$res,PDO::PARAM_STR);
    $stmt->bindParam('transactionId',$id,PDO::PARAM_STR);
    $stmt->execute();
    return $res;
  }
?>
