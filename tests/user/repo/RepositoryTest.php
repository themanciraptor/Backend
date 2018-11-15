<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/user/repo/Repository.php';
require_once 'src/user/model/User.php';
require_once 'tests/user/common.php';
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

    function test_get_ReturnsUser()
    {
        $user = self::$repo->get("st-000001");

        $this->assertEquals(getExistingUser(), $user);
    }

    function test_create_CreatesAUser()
    {
        $user_id = "st-000002";
        $first_name = "Quail";
        $last_name = "Eats";
        $email = "QuailEats@humans.com";
        $result_id = self::$repo->create($first_name, $last_name, $email, $user_id);

        $result = self::$repo->get($user_id);
        $this->assertEquals($first_name, $result->first_name);
        $this->assertEquals($last_name, $result->last_name);
        $this->assertEquals($email, $result->email);
        $this->assertNotNull($result->getCreated());
        $this->assertNotNull($result->getUpdated());
        $this->assertEquals($user_id, $result_id);

        // Clean up user so that consecutive tests will pass
        // TODO: ideally the table should be setup as part of the test :|
        self::$dbh->mutatorQuery("DELETE FROM User WHERE user_id = ?", "s", $user_id);
    }

    function test_update_UpdatesAUser()
    {
        
    }
}

?>
