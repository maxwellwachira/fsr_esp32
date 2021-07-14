<?php

namespace app\models;
use app\core\Model;
use app\config\Database;
use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * 
 */
class LoginModel extends Model
{
	public $con;
	public $firstname;
	public $secondname;
	public $email;
	public Database $database;

	public function __construct(){
		$this->database = new Database();
		$this->con = $this->database->getConnection_pdo();
	}

	public function userExists($email){

		$this->email = $email;
		$query = "SELECT email FROM 
	     			users 
	     			WHERE email = ?
	     			LIMIT 1";

	    
	    // prepare query statement
   		$stmt = $this->con->prepare($query);

	    // bind email 
	    $stmt->bindParam(1, $this->email);

	    // execute query
	    $stmt->execute();

		// query row count
		$num = $stmt->rowCount();
		// check if more than 0 record found
		if($num > 0){

			return true;

		}else if($num === 0){

			return false;
		}
	}
	public function checkPayment($email){

		$query = "SELECT pending_payment FROM 
		     			users 
		     			WHERE email = ?
		     			LIMIT 1";	
		// prepare query statement
   		$stmt = $this->con->prepare($query);

	    // bind email 
	    $stmt->bindParam(1, $email);

	    // execute query
	    $stmt->execute();

	    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

	    if((int)$row['pending_payment'] === 1){
	    	 session_start();
	    	 $_SESSION['email'] = $email;
	    	return true;
	    }else{
	    	return false;
	    }


	}
	public function login($email, $password){



		$query = "SELECT * FROM 
	     			users 
	     			WHERE email = ?
	     			LIMIT 1";

	    // prepare query statement
   		$stmt = $this->con->prepare($query);

	    // bind email 
	    $stmt->bindParam(1, $email);

	    // execute query
	    $stmt->execute();

	    $input_password = $password;
	    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
	    $type = (int)$row['type'];
	    $hashed_password = $row['password'];

	    $package = (int)$row['package'];
	    $pending_payment = (int)$row['pending_payment'];

	    /*switch ($package) {
	    	case 1:
	    		if(!$this->datediff(7)){
	    			
	    		}

	    		break;
	    	
	    	default:
	    		# code...
	    		break;
	    }*/
	    if(password_verify($input_password, $hashed_password)){
	    	// Password is correct, so start a new session
            session_start();
            
            // Store data in session variables
            $_SESSION["id"] = $row['id'];
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $row['firstname'].' '.$row['secondname'];
            $_SESSION['loggedin'] = true;
            if ($type === 1){
            	$_SESSION["type"] = 'admin';
            }else if($type === 2){
            	$_SESSION["type"] = 'student';
            } 

            if ($pending_payment == 1){
            	$_SESSION["subscription"] = false;
            }else if($pending_payment == 0){
            	$_SESSION["subscription"] = true;
            }                     
            
            // Redirect user to welcome page
            /*echo '<pre>';
			var_dump($_SESSION);
			echo '</pre>';*/
           
	    	return true;

	    }else {

	    	return false;
	    }
	}
	public function verifiedAccount($email){

		$query = "SELECT verified_account FROM 
	     			users 
	     			WHERE email = ? and verified_account = ?
	     			LIMIT 1";

	    // prepare query statement
   		$stmt = $this->con->prepare($query);


   		$true = 1;
	    // bind email 
	    $stmt->bindParam(1, $email);
	    $stmt->bindParam(2, $true);

	    
	    // execute query
	    $stmt->execute();

		// query row count
		$num = $stmt->rowCount();
		// check if more than 0 record found
		if($num > 0){

			return true;

		}else if($num === 0){

			return false;
		}

	}

	public function datediff($time){

		date_default_timezone_set("Africa/Nairobi");
		$now = date('Y/m/d H:i:s');
		$query = "SELECT updated_at from users WHERE id = ?";

		 // prepare query statement
   		$stmt = $this->con->prepare($query);
		// bind email 
	    $stmt->bindParam(1, $email);

	    // execute query
	    $stmt->execute();

	    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

	    $updated_date = $row['updated_at'];

	    $updated_date = date($updated_date); 

		    $diff = date_diff($now, $updated_date);

		     echo '<pre>';
			var_dump($diff);
			echo '</pre>';
           
	    if($diff >= $time){
	    	return true;
	    }else{
	    	return false;
	    }


	}
}
?>