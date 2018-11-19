<?php
require_once 'src/util/controller/controller.class.php';
require_once 'src/student/repo/Repository.php';
require_once 'src/util/sql/BaseSQL.php';

class StudentController extends Controller {
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
            case 'GET':
                $_data = $this->_repo->get($this->getPath()[1]);
                echo $this->response(200, $_data);
                break;
            case 'POST': 
                $_success = $this->_repo->create([ 
                                $this->getValueFromBody('user_id'), 
                                $this->getValueFromBody('first_name'), 
                                $this->getValueFromBody('last_name'), 
                                $this->getValueFromBody('email'), 
                                $this->getValueFromBody('address')
                            ]);
                if (!$_success) {
                    echo $this->response(500);
                }
                echo $this->response(201);
                break;
            case 'PUT':
                $_success = $this->_repo->update($_SESSION['USER_ID'], [
                                $this->getValueFromBody('first_name'), 
                                $this->getValueFromBody('last_name'), 
                                $this->getValueFromBody('email'), 
                                $this->getValueFromBody('address')
                            ]);
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