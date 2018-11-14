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
        self::assertEquals($testvar, $usr->first_name);
        
        // If we change the reference, the array should change, but the value on the object should not
        $refs[1] = &$testvar;
        self::assertNotEquals($testvar, $usr->last_name);
    }
}
?>
