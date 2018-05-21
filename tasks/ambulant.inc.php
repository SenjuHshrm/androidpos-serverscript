<?php
	class GetAmbulant {
		public function processReq($reqData){
			$req = array();
			$res = array();
			$req = explode(" ", $reqData);
			if(count($req) == 1){
				$req[1] = ' ';
			}
			$res = $this->fetchInfo($req);
			return $res;
		}
		private function fetchInfo($info){
			require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$xhrRes = array();
			$sql = 'CALL POS_fetchAmbInfo(:firstname, :lastname)';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':firstname', $info[0], PDO::PARAM_STR);
			$stmt->bindParam(':lastname', $info[1], PDO::PARAM_STR);
			$stmt->execute();
			while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
				$xhrRes['AMB_RES'][] = $res;
			}
			return $xhrRes;
		}
	}
?>
