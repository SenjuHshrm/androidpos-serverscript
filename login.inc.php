<?php
  include 'config.inc.php';
  if(isset($_POST['username']) && isset($_POST['password'])){
    $result='';
	  $username = $_POST['username'];
    $password = $_POST['password'];
	  $sql = 'CALL POS_login(:username,:password)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()){
		    $result=$stmt->fetchAll();
        foreach($result as $res){
          $xobj = $res['fullname'];
        }
    } elseif(!$stmt->rowCount()) {
			   $xobj="false";
    }
   	echo $xobj;
  	}
?>
