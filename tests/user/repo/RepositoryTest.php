<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/user/repo/Repository.php';
require_once 'src/user/model/User.php';
require_once 'tests/user/common.php';
use PHPUnit\Framework\TestCase;

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
        $userID = "st-000002";
        $email = "QuailEats@humans.com";
        $password = "mahpassword";
        $isAdmin = false;
        $resultID = self::$repo->create($email, $password, $userID);

        $result = self::$repo->get($userID);

        $this->assertTrue($result->verifyPassword($password));
        $this->assertEquals($email, $result->email);
        $this->assertEquals($isAdmin, $result->is_admin);
        $this->assertNotNull($result->getCreated());
        $this->assertNotNull($result->getModified());
        $this->assertEquals($userID, $resultID);

        self::delete($userID);
    }

    function test_update_UpdatesAUser()
    {
        $id = self::$repo->create('seconds@hotmeal.com', 'mahpassword');
        $before = $expectedUser = self::$repo->get($id);
        sleep(1); // modified only stamps the time down to the nearest second, need to wait so the modified time will be different

        $expectedUser = get_object_vars($expectedUser);
        $expectedUser["_password"] = "newpassword";
        $expectedUser = new User($expectedUser);

        self::$repo->update2($expectedUser);
        $after = self::$repo->get($id);

        $this->assertEquals($expectedUser->email, $after->email);
        $this->assertGreaterThan($before->getModified(), $expectedUser->getModified());
        $this->assertTrue($after->verifyPassword("newpassword"));

        self::delete($id);
    }

    private static function delete($id)
    {
        self::$dbh->mutatorQuery("DELETE FROM User WHERE user_id = ?", "s", $id);
    }
}

?>
