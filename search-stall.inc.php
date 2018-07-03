<?php
	require $_SERVER['DOCUMENT_ROOT'].'/tasks/search-stall.inc.php';
	$res = array();
	$SearchData = new GetTenant;
	$res = $SearchData->getInfo($_GET['name']);
	echo json_encode($res);
?>
