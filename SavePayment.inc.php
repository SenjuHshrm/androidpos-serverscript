<?php
  header('Content-Type: application/json;charset=utf-8');
  header('X-Requested-With: XMLHttpRequest');
	require $_SERVER['DOCUMENT_ROOT'].'/tasks/transaction.inc.php';
  $ResponseData = '';
	$saveTransaction = new ProcessTransaction;
  $RecData = file_get_contents('php://input');
  $JSONData = json_decode($RecData);
	$CustomerID = (int) $JSONData->CustomerID;
	$Payment = $JSONData->Payment;
	$CollectorID = $JSONData->CollectorID;
	$CollectorName = $JSONData->CollectorName;
  $ResponseData = $saveTransaction->process($CustomerID, $Payment, $CollectorID, $CollectorName);
  echo $ResponseData;
?>
