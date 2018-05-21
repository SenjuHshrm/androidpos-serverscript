<?php
class LocalStrat {
		public function AuthLogin($authUser, $authPass){
			require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$GetPass = 'CALL POS_AuthLogin(:username)';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$xhrResponse = array();
			$resObj = new stdClass();
			$stmt = $conn->prepare($GetPass);
			$stmt->bindParam(':username', $authUser, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()){
				$response = $stmt->fetchAll();
				foreach($response as $res){
					$testPass = $res['password'];
				}
				if($authPass == $testPass){
					$xhrResponse = $this->GetDeviceUser($authUser, $authPass);
				}
				else{
					$resObj->ID = '';
					$resObj->fullname = 'PassInc';
					$xhrResponse['USER'][0] = $resObj;
				}
			}
			else{
				$resObj->ID = '';
				$resObj->fullname = 'NoUsername';
				$xhrResponse['USER'][0] = $resObj;
			}
			return $xhrResponse;
		}

		private function GetDeviceUser($authUser, $authPass){
			require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$CreateConn = new DBConnect;
			$conn = $CreateConn->dbConn();
			$GetUser = 'CALL POS_GetDeviceUser(:username, :password)';
			$stmt = $conn->prepare($GetUser);
			$fullname = array();
			$stmt->bindParam(':username', $authUser, PDO::PARAM_STR);
			$stmt->bindParam(':password', $authPass, PDO::PARAM_STR);
			$stmt->execute();
			while($rn = $stmt->fetch(PDO::PARAM_STR)){
				$fullname['USER'][] = $rn;
			}
			return $fullname;
		}
	}
?>
