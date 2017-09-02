<?php
	class Database {
		
		private $servername = "spryiqdb.cvgl3kaxacs1.us-east-1.rds.amazonaws.com";
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


