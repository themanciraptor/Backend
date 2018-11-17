<?php
require_once 'src/util/controller/controller.class.php';
require_once 'src/user/repo/Repository.php';
require_once 'src/util/sql/BaseSQL.php';

class UserController extends Controller {
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
        process() : delegates the request based on method
    */
    public function process() {
        switch ($this->getMethod()) {
            case 'POST': 
                $_success = $this->_repo->create($this->getValueFromBody('email'), $this->getValueFromBody('password'));
                if (!$_success) {
                    echo $this->response(500);
                }
                echo $this->response(201);
                break;
            case 'PUT':
                $_user = new User($this->getValueFromBody('email'), $this->getValueFromBody('password'));
                $_success = $this->_repo->update($_user);
                if (!$_success) {
                    echo $this->response(500);
                }
                echo $this->response(201);
                break;
            default:
                throw new Exception('Method Not Allowed');
        }
    }
}
?>