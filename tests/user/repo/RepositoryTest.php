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
        $this->assertNotNull($result->getModified());
        $this->assertEquals($user_id, $result_id);

        self::delete($user_id);
    }

    function test_update_UpdatesAUser()
    {
        $id = self::$repo->create('Tiny', 'Tim', 'seconds@hotmeal.com');
        $expectedUser = self::$repo->get($id);
        sleep(1); // modified only stamps the time down to the nearest second, need to wait a second so that the modified time will be different

        $expectedUser->first_name = "Big";
        self::$repo->update($expectedUser);
        $actual = self::$repo->get($id);

        $this->assertEquals($expectedUser->first_name, $actual->first_name);
        $this->assertGreaterThan($expectedUser->getModified(), $actual->getModified());

        self::delete($id);
    }

    private static function delete($id)
    {
        self::$dbh->mutatorQuery("DELETE FROM User WHERE user_id = ?", "s", $id);
    }
}

?>
