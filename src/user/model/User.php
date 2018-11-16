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
        $this->user_id = uniqid();
        parent::__construct($params);
    }

    function toRefList(): array
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
