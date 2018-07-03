<?php
	class GetTenant {
		public function getInfo($name){
			require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$request = array();
			$request = $this->strSplt($name);
			$response = array();
			$sql = 'CALL POS_SearchStallTenant(:firstname, :lastname)';
			$conn = $CreateConn->dbConn();
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':firstname', $request[0], PDO::PARAM_STR);
			$stmt->bindParam(':lastname', $request[1], PDO::PARAM_STR);
			$stmt->execute();
			while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
				$response['STALL'][] = $res;
			}
			return $response;
		}

		private function strSplt($strInput){
			$req = array();
			$req = explode(" ",$strInput);
			if(count($req) == 1){
				$req[1] = ' ';
			}
			return $req;
		}
	}
?>
