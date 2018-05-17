<?php
	require $_SERVER['DOCUMENT_ROOT'].'/tasks/stall.inc.php';
	$stall = new GetStall;
	$ReqData = $_GET['info'];
	$result = array();
	$result = $stall->fetchInfo($ReqData);
	echo json_encode($result);
?>
