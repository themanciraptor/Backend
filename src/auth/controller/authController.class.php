<?php
require_once 'src/util/controller/controller.class.php';
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/user/repo/Repository.php';
require_once 'src/student/repo/Repository.php';

class AuthController extends Controller {
    private $_user_repo;
    private $_student_repo;
    /*
        Constructor : takes request and builds Controller parent object
        Params : $request object (the path)
    */
    public function __construct($request) {
        parent::__construct($request);
        $_db = new Sql();
        $this->_user_repo = new UserRepository($_db);
        $this->_student_repo = new StudentRepository($_db);
    }

    /*
        process() : checks whether the user is authorized; if not, tries to authorize
        throws : Unauthorized exception on inability to authorize
    */
    public function process() {
        if (!$this->authorized() && !$this->authorize()) {
            throw new Exception('Unauthorized');
        }
    }

     /*
        authorized() : returns true if the user is authorized, false otherwise
        Example return : true
    */
    private function authorized() {
        return (
            array_key_exists('USER_TOKEN', $_SESSION) && $_SESSION['USER_TOKEN'] != null && $_SESSION['USER_TOKEN'] == session_id()
        );
    }

    /*
        authorizeHelper() : authorizes an unauthorized user
    */
    private function authorize() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
        if ($this->getMethod() == 'OPTIONS') {
            echo $this->response(201);
            return true;
        }
        if ($this->getMethod() != 'POST' && ($this->getPath()[0] != 'login' || $this->getPath()[0] != 'register')) {
            throw new Exception('Unauthorized');
        }
        $id = $this->_user_repo->verify($this->getValueFromBody('email'), $this->getValueFromBody('password'));
        //TODO get password hash from database and throw an error if it doesn't match
        if (!$id) {
            throw new Exception('Unauthorized');
        }
        $this->getToken();
        $_SESSION['USER_TOKEN'] = session_id();
        $_SESSION['USER_ID'] = $id;
        return true;
    }

    /*
        deauthorize() : removes authorization
    */
    public function deauthorize() {
        $_SESSION['USER_TOKEN'] = null;
        $_SESSION['USER_ID'] = null;
        session_destroy();
    }

    /*
        register() : registers a new user
    */
    public function register() {
        header("Access-Control-Allow-Origin: http://localhost:8000, localhost:8000");
            header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
        if ($this->getMethod() == 'OPTIONS') {
            echo $this->response(201);
            return;
        }
        if ($this->getMethod() != 'POST') {
            return;
        }
        error_log ('>>> user');
        $_user_success = $this->_user_repo->create($this->getValueFromBody('email'), $this->getValueFromBody('password'));
        $this->authorize();
        error_log ('>>> student');
        $_student_success = $this->_student_repo->create([
                                'student_id' => $this->getValueFromBody('student_id'),
                                'user_id' => $_SESSION['USER_ID'],
                                'first_name' => $this->getValueFromBody('first_name'),
                                'last_name' => $this->getValueFromBody('last_name'),
                                'email' => $this->getValueFromBody('email'),
                                'address' => $this->getValueFromBody('address'),
                            ]);
        if (!$_user_success || !$_student_success) {
            throw new Exception('Unauthorized');
        }
    }

    /*
        getToken() : creates a token depending on the role using session_create_id()
                   : session_id() returns the token
    */
    public function getToken() {
        //don't create a new session if a session already exists
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_destroy();
            session_start();
        }

        $new_session_id = session_create_id();
        $_SESSION['TIMEOUT'] = time();
        session_commit();
        session_id($new_session_id);
        session_start();
    }
}

?>