<?php
require_once 'src/util/controller/controller.class.php';
require_once 'src/college/repo/Repository.php';
require_once 'src/util/sql/BaseSQL.php';

class CollegeController extends Controller {
    private $_repo;
    /*
        Constructor : takes request and builds Controller parent object
        Params : $request object (the path)
    */
    public function __construct($request) {
        parent::__construct($request);
        $_db = new Sql();
        $this->_repo = new CollegeRepository($_db);
    }

    /*
        process() : delegates the request based on method
    */
    public function process() {
        switch ($this->getMethod()) {
            case 'GET':
                $_data = $this->_repo->list();
                if (!$_data) {
                    echo $this->response(500);
                }
                echo $this->response(200, $_data);
                break;
            default:
                throw new Exception('Method Not Allowed');
        }
    }
}
?>