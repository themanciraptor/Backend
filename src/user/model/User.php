<?php
/**
 * This is the model for the user
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/repo/BaseModel.php";

class User extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $user_id = "";
    private $password = "";
    public $email = "";
    public $is_admin = false;
    
    function __construct(array $params = [])
    {
        // $this->user_id = $params["user_id"] ?: "";
        $this->password = array_key_exists("password", $params) ? $params['password']: "";
        unset($params['password']);
        // $this->email = $params["email"] ?: "";
        // $this->is_admin = $params["is_admin"] ?: false;
        // $this->user_id = uniqid();
        // parent::__construct(array_slice($params, -3));
        parent::__construct($params);
    }

    public function toRefList(): array
    {
        $reflist = parent::toRefList();
        array_splice( $reflist, 1, 0, array('password' => &$this->password) );

        return $reflist;
    }

    function verifyPassword($password): bool
    {
        return password_verify($password, $this->password);
    }
}
?>
