<?php
  header('Content-Type: application/json;charset=utf-8');
  header('X-Requested-With: XMLHttpRequest');
  include 'SaveData.inc.php';
  $ResponseData = '';
  $RecData = file_get_contents('php://input');
  $JSONData = json_decode($RecData);
  $type = $JSONData->Type;
  $OwnerName = $JSONData->OwnerName;
  $Business = $JSONData->Business;
  $Payment = $JSONData->Payment;
  $Collector = $JSONData->Collector;
  $ResponseData = SavePaymentData($type,$OwnerName,$Business,$Payment,$Collector);
  echo $ResponseData;
?>
