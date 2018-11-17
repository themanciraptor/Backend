<?php
require_once 'src/util/controller/controller.class.php';
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/user/repo/Repository.php';

class AuthController extends Controller {
    private $_repo;
    /*
        Constructor : takes request and builds Controller parent object
        Params : $request object (the path)
    */
    public function __construct($request) {
        parent::__construct($request);
        $_db = new Sql();
        $this->_repo = new UserRepository($_db);
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
        if ($this->getMethod() != 'POST' && $this->getPath()[0] != 'login') {
            throw new Exception('Unauthorized');
        }
        $id = $this->_repo->verify($this->getValueFromBody('email'), $this->getValueFromBody('password'));
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