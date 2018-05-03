<?php
  include 'config.inc.php';
	$result = '';
	$testPass = '';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql1 = 'SELECT password FROM market_db.user WHERE username = :username';

	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt1->execute();
	if($stmt1->rowCount()){
		$response = $stmt1->fetchAll();
		foreach($response as $res){
			$testPass = $res['password'];
		}
		if($password == $testPass){
			$sql2 = "SELECT CONCAT(usr_firstname,' ',usr_lastname) as fullname FROM market_db.user WHERE username = :username AND password = :password";
			$stmt2 = $conn->prepare($sql2);
			$stmt2->bindParam(':username', $username, PDO::PARAM_STR);
		  $stmt2->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt2->execute();
			$resname = $stmt2->fetchAll();
			foreach($resname as $rn){
				$fullname = $rn['fullname'];
			}
			$result = $fullname;
		}else{
			$result = 'PassInc';
		}
	}else{
		$result = 'NoUsername';
	}
	echo $result
?>
