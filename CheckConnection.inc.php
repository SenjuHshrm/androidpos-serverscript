<?php
	require $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
	$CreateConn = new DBConnect;
	$conn = $CreateConn->dbConn();
	try{
		$response = "";
		$sql = "SHOW TABLES FROM market_db";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$response = "ok";
	}catch(Exception $e){
		$response = "dbError";
	}finally{
		echo $response;
	}
?>
