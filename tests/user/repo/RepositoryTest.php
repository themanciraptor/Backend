<?php
require_once "src/util/sql/BaseSQL.php";
use src\user\model\User;
require_once "src/user/repo/Repository.php";
use PHPUnit\Framework\TestCase;
use phpDocumentor\Reflection\Types\Null_;

class UserRepositoryTest extends TestCase
{
    protected static $dbh;
    protected static $repo;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
        self::$repo = new UserRepository(self::$dbh);
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
        self::$repo = null;
    }

    function test_GetUserReturnsUser()
    {
        $user = self::$repo->getUser("st-000001");

        $this->assertEquals(self::getExistingUser(), $user);
    }

    private static function getExistingUser(): User
    {
        $values = array(
            "first_name" => "Carl",
            "last_name" => "Marks",
            "user_id" => "st-000001",
            "email" => "redsocs@rus.com",
            "created" => "2018-10-18 04:05:58",
            "updated" => "2018-10-18 04:05:58",
            "deleted" => Null
        );

        return User($values);
    }
}

?>
