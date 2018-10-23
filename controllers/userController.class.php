<?php
require_once 'controller.class.php';

class UserController extends Controller {
    /*
        Constructor : takes request and builds Controller parent object
        Params : $request object (the path)
    */
    public function __construct($request) {
        parent::__construct($request);
    }

    /*
        process() : delegates the request based on method
    */
    public function process() {
        switch ($this->getMethod()) {
            case 'GET':
                echo $this->response(200, Array('email' => 'get@derpmail.com'));
                break;
            case 'POST': 
                echo $this->response(200, Array('name' => 'post@derpmail.com'));
                break;
            case 'PUT':
                echo $this->response(200, Array('name' => 'put@derpmail.com'));
                break;
            case 'DELETE':
                echo $this->response(201);
                break;
            default:
                throw new Exception('Method Not Allowed');
        }
    }
}
?>