<?php
	class ProcessTransaction {
		public function process($customerid, $payment, $collectorID, $collectorName){
			require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$TransactionNumber = '';
			$CurrentDate = date('m/d/Y');
			$sql = 'CALL POS_SaveTransaction(:custID, :payment, :collectorID, :collectorName, :effDate)';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':custID', $customerid, PDO::PARAM_STR);
			$stmt->bindParam(':payment', $payment, PDO::PARAM_STR);
			$stmt->bindParam(':collectorID', $collectorID, PDO::PARAM_STR);
			$stmt->bindParam(':collectorName', $collectorName, PDO::PARAM_STR);
			$stmt->bindParam('effDate', $CurrentDate, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()){
				$result = $stmt->fetchAll();
				foreach($result as $res){
					$TransactionNumber = $this->generate_transaction_num($res[0]);
				}
			}elseif(!$stmt->rowCount()){
				$TransactionNumber = 'false';
			}
			return $TransactionNumber;
		}
		private function generate_transaction_num($id){
			require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$ORNum = '';
			$idLen = strlen($id);
			$TRNum = 9 - $idLen;
			$TrnGen = 'M';
			$sql = 'CALL POS_SaveTransactionNumber(:TransactionNum,:ID)';
			if($idLen <= 9){
				for($x= 0; $x < $TRNum; $x++){
					$TrnGen = $TrnGen . '0';
				}
				$ORNum = $TrnGen . $id;
			} else {
				$idOR = substr(strval($id), -9);
				$ORNum = $TrnGen . $idOR;
			}
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':TransactionNum', $ORNum, PDO::PARAM_STR);
			$stmt->bindParam(':ID', $id, PDO::PARAM_STR);
			$stmt->execute();
			return $ORNum;
		}

	}
?>
