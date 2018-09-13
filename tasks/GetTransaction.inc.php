<?php
   class get_transactions {
      public function fetchTransaction($user, $date){
         require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
         $CreateConn = new DBConnect;
         $conn = $CreateConn->dbConn();
         $res = "";
         $xhrRes = array();
         $sql = "CALL POS_getTotalDailyTransactionList(:user, :date)";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':user', $user, PDO::PARAM_STR);
         $stmt->bindParam(':date', $date, PDO::PARAM_STR);
         $stmt->execute();
         while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $xhrRes['LIST_TRNS'][] = $res;
         }
         return $xhrRes;
      }
   }
?>