<?php
  include 'config.inc.php';
  header('Content-Type: application/json;charset=utf-8');
  header('X-Requested-With: XMLHttpRequest');
  $ReqData = file_get_contents('php://input');
  $ResData = '';
  
  echo $ResData;
?>
