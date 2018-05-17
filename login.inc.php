<?php
  require $_SERVER['DOCUMENT_ROOT'].'/tasks/auth.inc.php';
	$authLogin = new LocalStrat;
	$result = array();
	$userinput = $_POST['username'];
	$passinput = $_POST['password'];
	$result = $authLogin->AuthLogin($userinput, $passinput);
	echo json_encode($result);
?>
