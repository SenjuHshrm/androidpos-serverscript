<?php
	require $_SERVER['DOCUMENT_ROOT'].'/tasks/ambulant.inc.php';
	$task = new GetAmbulant;
	$data = $_GET['info'];
	$result = array();
	$result = $task->fetchInfo($data);
	echo json_encode($result);
?>
