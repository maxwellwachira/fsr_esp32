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
$app->router->get('/all-courses', [CoursesController::class, 'allCourses']);
$app->router->get('/advanced-courses', [CoursesController::class, 'advancedCourses']);
$app->router->get('/shop', [ShopController::class, 'allItems']);
$app->router->get('/pro', [PagesController::class, 'pro']);
$app->router->get('/contact-us', [PagesController::class, 'contactUs']);
$app->router->post('/contact-us', [MailController::class, 'sendContactform']);
$app->router->get('/about', [PagesController::class, 'about']);
$app->router->get('/chat', [ChatController::class, 'messages']);
$app->router->post('/chat', [ChatController::class, 'messagesController']);
$app->router->get('/sign-in', [AuthController::class, 'loginGet']);
$app->router->post('/login', [AuthController::class, 'loginPost']);
$app->router->get('/sign-up', [AuthController::class, 'registerGet']);
$app->router->post('/register', [AuthController::class, 'registerPost']);
$app->router->get('/activate-account', [AuthController::class, 'accountGet']);
$app->router->get('/resend-activation-link', [AuthController::class, 'resendActivationLink']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/live', [ZoomController::class, 'liveClass']);
$app->router->get('/forgot-password', [AuthController::class, 'forgotPasswordGet']);
$app->router->post('/forgot-password', [AuthController::class, 'forgotPasswordPost']);
$app->router->get('/password-reset', [AuthController::class, 'passwordResetGet']);
$app->router->post('/password-reset', [AuthController::class, 'passwordResetPost']);
$app->router->get('/meeting', [ZoomController::class, 'liveMeeting']);
$app->router->get('/payments', [PesapalController::class, 'iframe']);
$app->router->get('/buy-item', [PesapalController::class, 'iframeShop']);
$app->router->get('/payment-verification', [PesapalController::class, 'verifyPayment']);
$app->router->get('/item-purchase-verification', [PesapalController::class, 'verifyItemPayment']);
$app->router->get('/ipn-listener', [PesapalController::class, 'ipnListener']);
$app->router->post('/ipn-listener', [PesapalController::class, 'ipnListener']);
//apiRoutes
$app->router->post('/zoom-signature', [ZoomController::class, 'zoomSignature']);
$app->router->post('/zoom-participants-list', [ZoomController::class, 'participantList']);
$app->router->get('/api-course-read', [CoursesController::class, 'readCourses']);
$app->router->get('/api-advanced-course-read', [CoursesController::class, 'readADvancedCourses']);
$app->router->get('/api-pro-package-read', [CoursesController::class, 'proPackage']);
$app->router->get('/api-shop-read', [ShopController::class, 'readItems']);


$app->run();
?> 