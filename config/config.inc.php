<?php
	class DBConnect {
		public function dbConn(){
			$config = $this->fetchSettings();
			$servername = trim($config[0]);
			$username = trim($config[1]);
			$password = trim($config[2]);
			$dbname = trim($config[3]);
			try {
			  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
			    //die("OOPs something went wrong");
					echo($e);
			}
			return $conn;
		}
		private function fetchSettings() {
			$settings = array();
			$loc = $_SERVER['DOCUMENT_ROOT'].'/connection.txt';
			$file = fopen($loc, 'r');
			while(!feof($file)){
				$settings[] = fgets($file);
			}
			fclose($file);
			return $settings;
		}
	}
?>
