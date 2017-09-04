<?php
	class Database {
		
		private $servername = "localshost";
		private $username = "johnsmith";
		private $password = "welcome2pune";
		private $db = "justdrop";
		public $conn;

		public function __construct() {
			
		}
		public function getConnection() {
			$this->conn = null;
			try {
				$this->conn = mysqli_connect($this->servername,$this->username,$this->password,$this->db);	    			    		
			} catch (Exception $ex) {
				echo "Error : ". $ex->getMessage();
			}	
			return $this->conn;
		}
	}
	 
?>


