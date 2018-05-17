<?php
	class GetStall {
		public function fetchInfo($stall){
			include $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
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
