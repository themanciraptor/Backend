<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/student/repo/Repository.php';
require_once 'tests/student/common.php';
use PHPUnit\Framework\TestCase;

class StudentRepositoryTest extends TestCase
{
    protected static $dbh;
    protected static $repo;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
        self::$repo = new StudentRepository(self::$dbh);
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
        self::$repo = null;
    }

    function test_get_ReturnsStudent()
    {
        $student = self::$repo->get("testid");

        $this->assertEquals(getExistingStudent(), $student);
    }

    function test_create_CreatesAStudent()
    {
        $stud = getExistingStudent();
        $stud->user_id = "st-000001";
        $stud->student_id = "booooooo";

        $this::$repo->create(get_object_vars($stud));

        $result = self::$repo->get($stud->user_id);

        $this->assertEquals($stud->email, $result->email);
        $this->assertEquals($stud->first_name, $result->first_name);
        $this->assertEquals($stud->last_name, $result->last_name);
        $this->assertEquals($stud->address, $result->address);
        $this->assertEquals($stud->user_id, $result->user_id);
        $this->assertEquals($stud->student_id, $result->student_id);
        $this->assertNotNull($result->getCreated());
        $this->assertNotNull($result->getModified());

        self::delete($stud->user_id);
    }

    function test_update_UpdatesAStudent()
    {
        $userID = 'atestid';
        self::$repo->create(['email' =>'combined@harms.com', 'user_id' => $userID]);
        $expectedStudent = self::$repo->get($userID);
        sleep(1); // modified only stamps the time down to the nearest second, need to wait so the modified time will be different

        $expectedStudent->email = "firsts@hotmeal.com";
        self::$repo->update($expectedStudent);
        $actual = self::$repo->get($userID);
        self::delete($userID); //delete entry from table now so that row is deleted whether tests pass or not.

        $this->assertEquals($expectedStudent->email, $actual->email);
        $this->assertEquals($expectedStudent->user_id, $actual->user_id);
        $this->assertGreaterThan($expectedStudent->getModified(), $actual->getModified());

    }

    private static function delete($id)
    {
        self::$dbh->mutatorQuery("DELETE FROM Student WHERE user_id = ?", "s", $id);
    }
}

?>
