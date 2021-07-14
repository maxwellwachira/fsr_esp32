<?php

namespace app\models;
use app\config\Database;
use app\controllers\MailController;
use \Kreait\Firebase\Factory;
/**
 * 
 */
class RegisterModel
{
	public $con;
	public $firstname;
	public $secondname;
	public $email;
	public $password;

	public Database $database;

	public function __construct(){
		$this->database = new Database();
		$this->con = $this->database->getConnection_pdo();
		$this->pending_payment = 1;
		$this->type = 2;
		$this->deleted = 0;
		$this->verified_account = 0;
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

	public function register($firstname, $secondname, $email,  $password, $ref){
			$factory = (new Factory)->withServiceAccount(dirname(__DIR__).'/firebase.json')->withDatabaseUri('https://fsr-app-d7690-default-rtdb.firebaseio.com/');

		 	$query = "INSERT INTO users (firstname, secondname, email, password, created_at)
            VALUES
                (?, ?, ?, ?, ?)";
  
		    // prepare query
		    $stmt = $this->con->prepare($query);
		    
		    $this->firstname = $firstname;
		    $this->secondname = $secondname;
		    $this->email = $email;
		   	$this->password = password_hash($password, PASSWORD_DEFAULT);

		   	date_default_timezone_set("Africa/Nairobi");
		    $created_at = date('Y/m/d H:i:s');
		  
		 
		    
		    // bind values
		    $stmt->bindParam(1, ucfirst($this->firstname));
		    $stmt->bindParam(2, ucfirst($this->secondname));
		    $stmt->bindParam(3, $this->email);
		    $stmt->bindParam(4, $this->password);
		    $stmt->bindParam(5, $created_at);	  

		    // create the user
		    if($stmt->execute()){
		  
		        // set response code - 201 created
		        http_response_code(201);
		        session_start();
		        $database = $factory->createDatabase();
				$newPost = $database
			    ->getReference('users')
			    ->push([
			        'firstname' => ucfirst($this->firstname),
			        'lastname' => ucfirst($this->secondname),
			        'email' => $this->email,
			        'password' => $this->password,
			        'created_at' => $created_at
			    ]);

				return true;	
		        
		       
		    }
		  
		    // if unable to create the device, tell the user
		    else{
		  
		        // set response code - 503 service unavailable
		        http_response_code(503);
		        
		  
		        // tell the user
		        //echo json_encode(array("message" => "internal_error"));
		        return false;
		    }

	}
}