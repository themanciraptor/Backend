<?php
/**
 * This is the model for the user
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/model/BaseModel.php";

class User extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $user_id = "";
    private $_password = "";
    public $email = "";
    public $is_admin = false;
    
    function __construct(array $params = [])
    {
        $this->_password = array_key_exists("_password", $params) ? $params['_password']: "";
        unset($params['_password']);

        parent::__construct($params);
    }

    public function toRefList(): array
    {
        $reflist = parent::toRefList();
        array_splice( $reflist, 1, 0, array('_password' => &$this->_password) );

        return $reflist;
    }

    function verifyPassword($_password): bool
    {
        return password_verify($_password, $this->_password);
    }

    function updatePasswordStatement(QueryBuilder $qb): QueryBuilder
    {
        $qb->addStatement("password", "s", password_hash($this->_password, PASSWORD_DEFAULT));

        return $qb;
    }
}
?>
