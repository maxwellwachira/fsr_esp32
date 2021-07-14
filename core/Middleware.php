<?php

namespace app\core;

class Middleware 
{
	public function loginMiddleware(){
		session_start();
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			session_destroy();
		   	Application::$app->request->redirect('/login');
		    exit;
		} 
		if (!isset($_SESSION["type"])){
			session_destroy();
			Application::$app->request->redirect('/login');
		    exit;
		}
		if($_SESSION["type"] === 'admin'){
			Application::$app->request->redirect('/admin-dashboard');
		    exit;
		}
		if($_SESSION["type"] === 'student'){
			Application::$app->request->redirect('/student-dashboard');
		    exit;
		}

	}
}