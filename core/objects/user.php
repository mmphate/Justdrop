
<?php
	class User {
		private $conn;
		private $utility;
		public function __construct($db) {
			$this->conn = $db;
		}
		
		
		public function isUserActive($email) {
			$email = mysqli_real_escape_string($this->conn,$email);
        	$result = mysqli_query($this->conn,"SELECT active FROM users WHERE email_id = '$email' LIMIT 1")->fetch_row();        	
        	return (count($result) > 0) ? $result[0] : false;
		}
		
		public function emailExists($email) {
			$email = mysqli_real_escape_string($this->conn,$email);
        	$result = mysqli_query($this->conn,"SELECT user_id FROM users WHERE email_id = '$email' LIMIT 1");        	
        	return ($result->num_rows > 0) ? true : false;
		}
		public function loggedIn() {
			return (isset($_SESSION['user_id'])) ? true : false;    
		}

		function userIdFromUsername($username){			
        	$username = mysqli_real_escape_string($this->conn,$username);
        	$result = mysqli_query($this->conn,"SELECT user_id FROM users WHERE email_id = '$username' ")->fetch_row();        	
        	return (count($result) > 0) ? $result[0] : '';
		}

		function usernameFromUserId($userId){			
        	$userId = mysqli_real_escape_string($this->conn,$userId);
        	$result = mysqli_query($this->conn,"SELECT CONCAT(first_name,' ',last_name) FROM users WHERE user_id = '$userId' ")->fetch_row();        	
        	return (count($result) > 0) ? $result[0] : '';
		}
		function login($username,$password){
	        $username = mysqli_real_escape_string($this->conn,$username);
	        //$user_id = user_id_from_user_name($username);
	        $password = md5($password);
	        $result = mysqli_query($this->conn,"SELECT user_id FROM users WHERE email_id = '$username' AND password = '$password'")->fetch_row();	        
	       
	        return (count($result) > 0) ? $result[0] : false;
    	}
    	function checkOldPassword($user_id,$old_Password){
       		$old_Password = md5($old_Password);
       		$result = mysqli_query($this->conn,"SELECT user_id FROM users WHERE user_id = '$user_id' AND password = '$old_Password'");       		
       		return ($result->num_rows > 0) ? true : false;  
   		}
   		function changePassword($user_id,$password){
       		$password = md5($password);
       		$result = mysqli_query($this->conn,"UPDATE users SET password = '$password' WHERE user_id='$user_id'");
       		return ($result->num_rows > 0) ? true : false;  
   		}
   		function registerUser($first_Name,$last_Name,$email,$password) {       
	        $first_Name = mysqli_real_escape_string($this->conn,$first_Name);
	        $last_Name = mysqli_real_escape_string($this->conn,$last_Name);
	        $email = mysqli_real_escape_string($this->conn,$email);
	        $password = md5(mysqli_real_escape_string($this->conn,$password));
	        $email_code = md5($email + microtime());
	        
	        mysqli_query($this->conn, "INSERT INTO users(first_Name,last_Name,email_Id,password,email_code) VALUES('$first_Name','$last_Name','$email','$password','$email_code')");
	        $this->createAcountDirectory($this->userIdFromUsername($email));
	        //$this->email($email,"JustDrop-Activate your account.", "Hello ".$first_Name."\n\nYou need to activate your account , so use the link below : \n\n Link - http://localhost/JustDrop/activate.php?email=".$email."&code=".$email_code."\n\n-JustDrop");
    	}

    	function email($to,$subject,$message) {
       		mail($to, $subject, $message,"From: kerurevijay@gmail.com") ;//or die(header("Location: Signup.php?fail"));
   		}
   		function createAcountDirectory($user_id){
	       	$rootDir='UserAccounts';
	       	mkdir($rootDir.'/'.$user_id);
	       	mkdir($rootDir.'/'.$user_id.'/Uploads');
	       	mkdir($rootDir.'/'.$user_id.'/Profile');
	       	mkdir($rootDir.'/'.$user_id.'/Uploads/thumbs');
	       	mkdir($rootDir.'/'.$user_id.'/Profile/thumbs');
       		mkdir($rootDir.'/'.$user_id.'/Profile/thumbs_32');
   		}
	}
?>