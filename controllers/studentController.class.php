<?php
require_once 'controller.class.php';

class StudentController extends Controller {
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
                echo $this->response(200, Array('name' => 'Get Derpison'));
                break;
            case 'POST': 
                echo $this->response(200, Array('name' => 'Post Derpison'));
                break;
            case 'PUT':
                echo $this->response(200, Array('name' => 'Put Derpison'));
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