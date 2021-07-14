<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\SubscribeModel;
use app\models\CustomSession;

class PagesController
{

	public function home(){
		$params = [];
		return Application::$app->router->renderView('index', $params);
	}

	public function graphs(){
		session_start();
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			session_destroy();
		   	Application::$app->request->redirect('/');
		    exit;
		}
		$params = [];
		return Application::$app->router->renderView('data', $params);
	}

	public function about(){
		$params = [];
		return Application::$app->router->renderView('about', $params);
	}

	public function customSession(){

		$customSession = new CustomSession();
		$method = Application::$app->request->getMethod();
		if($method === 'post'){
			$body = Application::$app->request->getBody();
			if($customSession->scheduleExists($body['time'], $body['date'])){
				$params = ['message' => 'Someone else has also scheduled for a session at the same time<br> Please Select a different time or date'];
				echo json_encode($params);
				exit;
			}
			if(!$customSession->scheduleSession($body['category'], $body['title'], $body['description'], $body['time'], $body['hours'], $body['date'])){
				$params = ['message' => 'Unable to add user'];
			}else{
				$price = round(19 * (float)$body['hours'], 2);
				session_start();
				$encrypted_user = urlencode(base64_encode($_SESSION['name']));
				$encrypted_price = urlencode(base64_encode('you cannot even guess how much a custom schedule cost '.$price));
				$encrypted_type = urlencode(base64_encode('customSession'));
				$link = '/payments?user='.$encrypted_user.'&price='.$encrypted_price.'&type='.$encrypted_type;

				$params = ['message' => 'success', 'price' => $price, 'link' => $link];
			}
			echo json_encode($params);
			exit;
		}
	}



	public  function contactUs(){
		$params = [];
		return Application::$app->router->renderView('contact-us', $params);
	}

	public static function handleContact(Request $request){
		$params = [];
		$body = $request->getBody();	
	}

	public static function adminDashboard(){
		$params = [];
		return Application::$app->router->renderView('admin/index', $params);
	}
	public static function enroll(){
		$params = [];
		return Application::$app->router->renderView('enroll', $params);
	}
	public static function FAQ(){
		$params = [];
		return Application::$app->router->renderView('faq', $params);
	}
	public static function terms(){
		$params = [];
		return Application::$app->router->renderView('terms', $params);
	}
	public function subscribe(){
		$subscribe = new SubscribeModel();
		$method = Application::$app->request->getMethod();
		if($method === 'post'){
			$body = Application::$app->request->getBody();
			if($subscribe->userExists($body['email'])){
				$params = ['message' => 'exists'];
				echo json_encode($params);
				exit;
			}
			if(!$subscribe->addUser($body['email'])){
				$params = ['message' => 'Unable to add user'];
			}else{
				$params = ['message' => 'success'];
			}
			echo json_encode($params);
			exit;

		}
	}
}
?>