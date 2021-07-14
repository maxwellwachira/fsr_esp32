<?php

namespace app\controllers;
use app\core\Application;
use app\core\Request;
use app\models\RegisterModel;
use app\models\LoginModel;
use app\models\otp;
use app\models\PasswordRecovery;
use app\core\csrf;

/**
 * 
 */




class AuthController 
{
	public array $errors = array();
	public csrf $csrf;
	public otp $otp;
	public MessageController $sendtext;

	public function __construct(){
		$this->csrf = new csrf();
		//$this->otp = new otp();
		//$this->sendtext = new MessageController();
	}
	
	public function loginGet(){
		$method = Application::$app->request->getMethod();
		if($method === 'get'){
			$csrf_token =  $this->csrf->set_csrf();
			$body = Application::$app->request->getBody();
			$path = Application::$app->request->getFullPath();
			if(str_contains($path, 'payments')){
				$path = str_replace('/sign-in?returnurl=/', '/', $path);
				return Application::$app->router->renderView('login', ['message' => $csrf_token, 'returnurl' => '<input type="hidden" id = "returnurl" name="returnurl" value="'.$path.'">']);
			}else if(str_contains($path, 'buy-item')){
				$path = str_replace('/sign-in?returnurl=/', '/', $path);
				return Application::$app->router->renderView('login', ['message' => $csrf_token, 'returnurl' => '<input type="hidden" id = "returnurl" name="returnurl" value="'.$path.'">']);
			}
			else{
				return Application::$app->router->renderView('login', ['message' => $csrf_token, 'returnurl' => '<input type="hidden" id = "returnurl" name="returnurl" value="'.$body['returnurl'].'">']);
			}
		}
	} 

	public function loginPost(){
		
		$loginModel = new LoginModel();
		$method = Application::$app->request->getMethod();
		if($method === 'post'){

			$body = Application::$app->request->getBody();

			if(!$loginModel->userExists($body['email'])){
				$params = ['message' => 'No account found with that email address'];
				echo json_encode($params);	
				exit;
			}else{
				if($loginModel->login($body['email'], $body['password'])){
						$params = ['message' => 'success'];
						echo json_encode($params);
						exit;
					
				}else{
					$params = ['message' => 'Wrong Password'];
					echo json_encode($params);
					exit;
				}
			}	
		}
	}

	public function registerGet(){
		$method = Application::$app->request->getMethod();
		if($method === 'get'){
			$csrf_token =  $this->csrf->set_csrf();
			$body = Application::$app->request->getBody();
			return Application::$app->router->renderView('register', ['message' => $csrf_token, 'ref' => '<input type="hidden" id = "ref" name="ref" value="'.$body['ref'].'">']);
		}
	}

	public function registerPost(){

		$registerModel = new RegisterModel();
		$method = Application::$app->request->getMethod();
		if($method === 'post'){

			$body = Application::$app->request->getBody();
			/*if(!$registerModel->refExists($body['ref'])){
				$params = ['message' => 'Referral Code does not Exists <br> Click <a class = "mr-2" href = "/register">Here to register</a>'];
				echo json_encode($params);	
				exit;
			}*/

			if(!filter_var($body['email'], FILTER_VALIDATE_EMAIL)){
				$params = ['message' => 'Invalid Email'];
				echo json_encode($params);	
				exit;
			} else {
				if($registerModel->userExists($body['email'])){
					$params = ['message' => 'Account Exists'];
					echo json_encode($params);
					exit;
				} else{
					if(!$registerModel->register(ucfirst($body['firstname']), ucfirst($body['secondname']), $body['email'], $body['password'], $body['ref'])){
						$params = ['message' => 'Server Error. Contact Admin'];		
					}else{

						$params = ['message' => 'success'];
						
					}
					echo json_encode($params);	
					exit;	
				}
			}			
		}	
	}

	public function forgotPasswordGet(){
		$method = Application::$app->request->getMethod();
		if($method === 'get'){
			$csrf_token =  $this->csrf->set_csrf();
			return Application::$app->router->renderView('forgot-password', ['message' => $csrf_token]);
		}	
	}

	public function forgotPasswordPost(){
		$passwordRecovery= new PasswordRecovery();
		$method = Application::$app->request->getMethod();

		if($method === 'post'){

			$body = Application::$app->request->getBody();

			if(!$this->csrf->is_csrf_valid($body['csrf'])){
				$params = ['message' => 'Security Bridge Issue'];
				echo json_encode($params);	
				exit;
			} else {

				if(!$passwordRecovery->userExists($body['email'])){
					$params = ['message' => 'Account Does not Exists'];
					echo json_encode($params);	
					exit;
				} else {
					if($passwordRecovery->sendRecoveryEmail()){
						$params = ['message' => 'success'];
						echo json_encode($params);	
						exit;
					}else {
						$params = ['message' => 'Send Error. Try Again'];
						echo json_encode($params);		
					}
				}
			}
		}	
	}


	public function accountGet(){

		$registerModel= new RegisterModel();
		$method = Application::$app->request->getMethod();

		if($method === 'get'){

			$body = Application::$app->request->getBody();
			if($registerModel->tokenExists($body['token'], $body['email'])){
				return Application::$app->router->renderView('account-verfication', ['message' => '<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check animated swing infinite"></i>Your account has been activated. Click <a href = "/sign-in">here to sign in</a></div>']);
			}else{
				return Application::$app->router->renderView('account-verfication',  ['message' => '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>Token Does not Exist</div>']);
			}

		}

	}

	public function resendActivationLink(){
		$registerModel= new RegisterModel();
		$method = Application::$app->request->getMethod();

		if($method === 'get'){
			$body = Application::$app->request->getBody();
			if(!$registerModel->userExists($body['email'])){
				return Application::$app->router->renderView('account-verfication',  ['message' => '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>User Does not Exist</div>']);				
			}else{
				if ($registerModel->emailVerification($body['email'])) {
					$link = '/resend-activation-link?email='.$body['email'];
					return Application::$app->router->renderView('account-verfication', ['message' => '<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check animated swing infinite"></i>An Email with activation link has been sent to your email address.</div><div>Did not get email?  Click <a href = "'.$link.'">here to resend email</a></div>']);
				}else{
					return Application::$app->router->renderView('account-verfication',  ['message' => '<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>Error. Contact Admin</div>']);
				}
			}

		}
	}


	public function passwordResetGet(){

		$passwordRecovery= new PasswordRecovery();
		$method = Application::$app->request->getMethod();

		if($method === 'get'){

			$body = Application::$app->request->getBody();
			if($passwordRecovery->tokenExists($body['rst'])){
				return Application::$app->router->renderView('password-reset', ['message' => '<input type="hidden" id = "rst_token" name="rst_token" value="'.$body['rst'].'">']);
			}else{
				return Application::$app->router->renderView('forgot-password');
			}

		}

	}

	public function passwordResetPost(){

		$passwordRecovery= new PasswordRecovery();
		$method = Application::$app->request->getMethod();

		if($method === 'post'){
			$body = Application::$app->request->getBody();
			if($passwordRecovery->updatePassword($body['rst_token'], $body['password'])){
				$params = ['message' => 'success'];
				echo json_encode($params);	
				exit;
			}else{
				$params = ['message' => 'Error. Contact Admin or try again'];
				echo json_encode($params);	
				exit;	
			}

		}

	}

	public function logout(){
		session_start();
		session_destroy();
		$method = Application::$app->request->getMethod();
		if($method === 'get'){
			$body = Application::$app->request->getBody();
			if(!$body['returnurl']){
				Application::$app->request->redirect('/');
				exit();
			}else{
				Application::$app->request->redirect($body['returnurl']);
				exit();
			}
			
		}
	}


	public function otpGet(){

		$method = Application::$app->request->getMethod();

		if($method === 'get'){
			return Application::$app->router->renderView('otp-verification');
		}
		//return Application::$app->router->renderView('otp-verification');
	}

	public function otpPost(){
		$method = Application::$app->request->getMethod();
		if($method === 'post'){
			$body = Application::$app->request->getBody();
			if($this->otp->isValid($body['otp'])){
				$params = ['message' => 'success'];
				echo json_encode($params);	
				exit;
			}else{
				$params = ['message' => 'Invalid Code'];
				echo json_encode($params);
				exit();
			}
		}
	}


}
?>