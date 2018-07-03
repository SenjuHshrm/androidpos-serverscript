<?php
	class UpdateInfo {
		public function update($stallid,$stallnum,$sqm){
			require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
			$DBConn = new DBConnect;
			$conn = $DBConn->dbConn();
			$sql = 'CALL POS_SaveInfo(:StallID,:StallNum,:SQM)';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':StallID', $stallid, PDO::PARAM_INT);
			$stmt->bindParam(':StallNum', $stallnum, PDO::PARAM_STR);
			$stmt->bindParam(':SQM', $sqm, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount() >= 0){
				return 'success';
			} else {
				return 'failed';
			}
		}
	}
?>
