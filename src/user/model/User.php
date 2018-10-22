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
    public $first_name = "";
    public $last_name = "";
    public $user_id = "";
    public $email = "";
    
    function __construct(array $params)
    {
        parent::BaseRepo();
        foreach ($params as $key => $value) {
            $this[$key] = $value;
        }
    }

    public function toRefList(): array
    {
        $scanList = [];
        foreach ($variable as &$value) {
            array_push($scanList, $value);
        }
        return $scanList;
    }
}
?>
