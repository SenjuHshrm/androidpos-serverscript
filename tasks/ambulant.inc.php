<?php
	class GetAmbulant {
		public function fetchInfo($info){
			require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$xhrRes = array();
			$sql = 'CALL POS_fetchAmbInfo(:firstname)';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':firstname', $info, PDO::PARAM_STR);
			$stmt->execute();
			while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
				$xhrRes['AMB_RES'][] = $res;
			}
			return $xhrRes;
		}
	}
?>
