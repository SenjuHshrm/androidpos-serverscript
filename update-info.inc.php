<?php
	header('Content-Type: application/json;charset=utf-8');
	header('X-Requested-With: XMLHttpRequest');
	require $_SERVER['DOCUMENT_ROOT'].'/tasks/update.inc.php';
	$SaveData = new UpdateInfo;
	$JSONData = json_decode(file_get_contents('php://input'));
	$StallID = (int) $JSONData->StallID;
	$StallNum = $JSONData->StallNum;
	$Measurement = $JSONData->Measurement;
	$response = $SaveData->update($StallID, $StallNum, $Measurement);
	echo $response;
?>
