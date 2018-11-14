<?php
require_once 'src/user/model/User.php';
require_once 'tests/user/common.php';

use PHPUnit\Framework\TestCase;
use phpDocumentor\Reflection\Types\Null_;

class UserModelTest extends TestCase
{
    function test_toRefList_GetsListOfReferences() {
        $usr = getExistingUser();
        $testvar = "Yas!";

        $refs = $usr->toRefList();

        // If we change the value, value on object should change
        $refs[0] = $testvar;
        // self::assertEquals($usr->first_name, $testvar);
        
        // If we change the reference, the array should change, but the value on the object should not
        $refs[1] = &$testvar;
        self::assertNotEquals($usr->last_name, $testvar);

        self::assertNull(date(DATE_ISO8601));
    }
}
?>
