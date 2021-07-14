<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/mailjet/vendor/autoload.php';
require_once __DIR__.'/../fb/vendor/autoload.php';


use app\controllers\PagesController; 
use app\controllers\AdminController;
use app\controllers\MailController;
use app\controllers\AuthController;
use app\controllers\ZoomController;
use app\controllers\PesapalController;
use app\controllers\StudentController;
use app\controllers\CoursesController;
use app\controllers\ChatController;
use app\controllers\ShopController;
use app\core\Application;
use app\core\Model;
use app\models\RegisterModel;
use app\core\Middleware;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [PagesController::class, 'home']);
$app->router->get('/home', [PagesController::class, 'home']);
$app->router->post('/custom-session', [PagesController::class, 'customSession']);
$app->router->get('/404', [PagesController::class, 'notFound']);
$app->router->get('/pro', [PagesController::class, 'pro']);
$app->router->get('/contact-us', [PagesController::class, 'contactUs']);
$app->router->post('/contact-us', [MailController::class, 'sendContactform']);
$app->router->get('/about', [PagesController::class, 'about']);
$app->router->get('/sign-in', [AuthController::class, 'loginGet']);
$app->router->post('/login', [AuthController::class, 'loginPost']);
$app->router->get('/sign-up', [AuthController::class, 'registerGet']);
$app->router->post('/register', [AuthController::class, 'registerPost']);
$app->router->get('/activate-account', [AuthController::class, 'accountGet']);
$app->router->get('/resend-activation-link', [AuthController::class, 'resendActivationLink']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/forgot-password', [AuthController::class, 'forgotPasswordGet']);
$app->router->post('/forgot-password', [AuthController::class, 'forgotPasswordPost']);
$app->router->get('/password-reset', [AuthController::class, 'passwordResetGet']);
$app->router->post('/password-reset', [AuthController::class, 'passwordResetPost']);

//apiRoutes


$app->run();
?> 