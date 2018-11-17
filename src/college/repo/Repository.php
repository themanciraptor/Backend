<?php
/**
 * College Repository is for basic data update or access to College table.
 * 
 * @author: Ezra Carter
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
require_once "src/util/sql/Interface.php";
require_once "src/college/model/College.php";

class CollegeRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        self::$db = $db;
    }

    // list all the educational institutions in our db
    public function list(): array
    {
        $getStudentQuery = "SELECT * FROM College";
        $ite = self::$db->accessorQuery($getStudentQuery, '');

        $college = new College();
        $college = $college->toRefList();
        $colleges = [];
        $ite->scan(...$college);
        while($ite->next()) {
            array_push($colleges, new College($college));
        }

        return $colleges;
    }
}

?>
