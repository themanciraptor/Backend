<?php
require_once 'controller.class.php';

class AuthController extends Controller {
    /*
        Constructor : takes request and builds Controller parent object
        Params : $request object (the path)
    */
    public function __construct($request) {
        parent::__construct($request);
    }

    /*
        implemented for the sake of implementing
    */
    public function process() {
    }

    /*
        process() : checks whether the user is authorized; if not, tries to authorize
        throws : Unauthorized exception on inability to authorize
    */
    public function authorize() {
        if (!$this->authorized() && !$this->authorizeHelper()) {
            throw new Exception('Unauthorized');
        }
    }

     /*
        authorized() : returns true if the user is authorized, false otherwise
        Example return : true
    */
    private function authorized() {
        return (
            array_key_exists('USER_EMAIL', $_SESSION) && $_SESSION['USER_EMAIL'] != null && 
            array_key_exists('USER_TOKEN', $_SESSION) && $_SESSION['USER_TOKEN'] != null
        );
    }

    /*
        authorizeHelper() : authorizes an unauthorized user
    */
    private function authorizeHelper() {
        if ($this->getMethod() != 'POST' && $this->getPath()[0] != 'login') {
            throw new Exception('Unauthorized');
        }
        $_SESSION['USER_EMAIL'] = array_key_exists('email', $this->getBody()) ? $this->getBody()['email'] : null;
        $password = array_key_exists('password', $this->getBody()) ? $this->getBody()['password'] : null;
        if ($password === null) {
            throw new Exception('Unauthorized');
        }
        //TODO get password hash from database and throw an error if it doesn't match
        $this->getToken();
        $_SESSION['USER_TOKEN'] = session_id();
        return true;
    }

    /*
        deauthorize() : removes authorization
    */
    public function deauthorize() {
        $_SESSION['USER_EMAIL'] = null;
        $_SESSION['USER_TOKEN'] = null;
    }

    /*
        getToken() : creates a token depending on the role using session_create_id()
                   : session_id() returns the token
    */
    public function getToken() {
        //don't create a new session if a session already exists
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $role = $this->getRole();
        $new_session_id = session_create_id($role);
        $_SESSION['TIMEOUT'] = time();
        session_commit();
        session_id($new_session_id);
        session_start();
    }
    
    /*
        getRole() : returns the role as a string
    */
    private function getRole() {
        //TODO define roles
        return 'user';
    }
}

?>