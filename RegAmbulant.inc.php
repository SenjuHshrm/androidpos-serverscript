<?php
   header('Content-Type: application/json;charset=utf-8');
   header('X-Requested-With: XMLHttpRequest');
   require $_SERVER['DOCUMENT_ROOT'].'/tasks/RegAmb.inc.php';
   $response_data = "";
   $ProReg = new RegisterAmbulant;
   $InputData = file_get_contents('php://input');
   $JSONData = json_decode($InputData);
   $FName = $JSONData->FirstName;
   $MName = $JSONData->MiddleName;
   $LName = $JSONData->LastName;
   $business = $JSONData->BusinessType;
   $loc = $JSONData->Location;
   $locNum = $JSONData->LocationNumber;
   $response_data = $ProReg->proc_reg($FName, $MName, $LName, $business, $loc, $locNum);
   echo $response_data;
?>