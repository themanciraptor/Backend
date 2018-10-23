<?php
/*
    ENTRY POINT
*/
require_once 'controllers/authController.class.php';
require_once 'controllers/studentController.class.php';
require_once 'controllers/userController.class.php';

function session_control_start() {
    session_start();
    // No old session IDs allowed
    if (array_key_exists('TIMEOUT', $_SERVER) && $_SESSION['TIMEOUT'] < time() - 180) {
        session_destroy();
        session_start();
    }
}

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

$auth = new AuthController($_SERVER['REQUEST_URI']);
ini_set('session.use_strict_mode', 1);
session_control_start();

try {
    $auth->process();
    switch ($auth->getPath()[0]) {
        case 'login': 
            break;
        case 'logout': 
            $auth->deauthorize();
            break;
        case 'student':
            $student = new StudentController($_SERVER['REQUEST_URI']);
            $student->process();
            break;
        case 'user':
            $user = new UserController($_SERVER['REQUEST_URI']);
            $user->process();
            break;
        default:
            $auth->response(404, Array('error' => 'Not Found'));
            break;
    }
} catch (Exception $e) {
    $statusCode = 500;
    $statusMessage = 'Internal Server Error';
    if ($e->getMessage() == 'Unauthorized') {
        $statusCode = 401;
        $statusMessage = 'Unauthorized';
    } else if ($e->getMessage() == 'Method Not Allowed') {
        $statusCode = 405;
        $statusMessage = 'Method Not Allowed';
    }
    header("HTTP/1.1 " . $statusCode . " " . $statusMessage);
    echo json_encode(Array('error' => $e->getMessage()));
}

session_destroy();
?>