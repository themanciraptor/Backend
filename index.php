<?php
/*
    ENTRY POINT
*/
require_once 'src/auth/controller/authController.class.php';
require_once 'src/student/controller/studentController.class.php';
require_once 'src/user/controller/userController.class.php';
require_once 'src/college/controller/collegeController.class.php';
require_once 'src/student_term_data/controller/studentTermDataController.class.php';

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
session_control_start();

try {
    if ($auth->getPath()[0] == 'register') {
        $auth->register();
    }
    $auth->process();
    switch ($auth->getPath()[0]) {
        case 'register':
        case 'login': 
            echo $auth->response(201);
            break;
        case 'logout': 
            $auth->deauthorize();
            echo $auth->response(201);
            break;
        case 'student':
            $student = new StudentController($_SERVER['REQUEST_URI']);
            $student->process();
            break;
        case 'user':
            $user = new UserController($_SERVER['REQUEST_URI']);
            $user->process();
            break;
        case 'college':
            $college = new CollegeController($_SERVER['REQUEST_URI']);
            $college->process();
        case 'studentterm':
            $term = new StudentTermDataController($_SERVER['REQUEST_URI']);
            $term->process();
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

?>