<?php
   header('Content-Type: application/json;charset=utf-8');
   header('X-Requested-With: XMLHttpRequest');
   require $_SERVER['DOCUMENT_ROOT'].'/tasks/GetTransaction.inc.php';
   $reqData = json_decode(file_get_contents('php://input'));
   $res = array();
   $list = new get_transactions;
   $res = $list->fetchTransaction($reqData->user,$reqData->date);
   echo json_encode($res);
?>