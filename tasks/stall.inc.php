<?php
	class GetStall {
		public function fetchInfo($stall){
			require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$xrRes = array();
			$sql = 'CALL POS_fetchStallInfo(:stallNum)';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':stallNum', $stall, PDO::PARAM_STR);
			$stmt->execute();
			while($res = $stmt->fetch(PDO::PARAM_STR)){
				$xrRes['STALL_RES'][] = $res;
			}
			return $xrRes;
		}
	}
?>
