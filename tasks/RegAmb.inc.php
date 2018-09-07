<?php
 class RegisterAmbulant {
    public function proc_reg($firstname, $middlename, $lastname, $businessType, $location, $locationNum){
      require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php';
      $CreateConn = new DBConnect;
      $conn = $CreateConn->dbConn();
      $res = "";
      $sql = 'CALL POS_AddAmbulant(:firstname, :middlename, :lastname, :business, :location, :locationNum)';
      try {
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
         $stmt->bindParam(':middlename', $middlename, PDO::PARAM_STR);
         $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
         $stmt->bindParam(':business', $businessType, PDO::PARAM_STR);
         $stmt->bindParam(':location', $location, PDO::PARAM_STR);
         $stmt->bindParam(':locationNum', $locationNum, PDO::PARAM_STR);
         $stmt->execute();
         $res = "true";
      } catch(Exception $e) {
         $res = "false";
      }
      return $res;
    }
 }
?>