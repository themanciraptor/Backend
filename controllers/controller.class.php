<?php

abstract class Controller {
    /*
        $method : HTTP method of incoming request
        getMethod() : returns the method as an uppercase string
            Example return : 'GET'
    */
    private $method = '';
    public function getMethod() {
        return $this->method;
    }

    /*
        $path : the URI path of the request
        getPath() : returns the path as an array split by /'s
            Example return : ['students', '3'] (if the URI was sasma.bj/students/3)
    */
    private $path = '';
    public function getPath() {
        return $this->path;
    }

    /*
        $body : the body of the request (null if request was GET or DELETE)
        getBody() : returns the body as an object
            Example return : { studentId : 3, studentFirstName : 'Leroy', studentLastName : 'Jenkins' }
    */
    private $body = null;
    public function getBody() {
        return $this->body;
    }

    /*
        Constructor : takes request and builds Controller object
        Params : $request object
    */
    public function __construct($request) {
        header("Content-Type: application/json");
        $this->path = explode('/', trim($request, '/'));
        $this->method = strtoupper(array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER) ? $_SERVER['HTTP_X_HTTP_METHOD'] : $_SERVER['REQUEST_METHOD']);
        $bodyRaw = file_get_contents("php://input");
        $this->body = json_decode($bodyRaw, true);
        var_dump($this->body);
    }

    /*
        process : processes the request
        Must be implemented in children classes
    */
    abstract public function process();

    /*
        response($data, $statusCode) : sends HTTP response with body $data and status $statusCode
        Params : $data object and $statusCode integer (200, 404, 500, etc)
    */
    public function response($statusCode, $data = null) {
        header("HTTP/1.1 " . $statusCode . " " . $this->getStatus($statusCode));
        echo json_encode($data);
    }

    /*
        getStatus : returns the status associated to $code
        Params : $code integer HTTP status (200, 404, 500, etc)
        Example return : 'Not Found' for $code = 404
    */
    private function getStatus($code) {
        $status = array(  
            200 => 'OK',
            201 => 'No Content',
            401 => 'Unauthorized',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 
        return ($status[$code]) ? $status[$code] : $status[500]; 
    }
}

?>