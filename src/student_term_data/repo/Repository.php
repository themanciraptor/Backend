<?php
/**
 * StudentTermData Repository is for basic data update or access to StudentTermData table.
 * 
 * @author: Ezra Carter
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
require_once "src/util/sql/Interface.php";
require_once "src/student_term_data/model/StudentTermData.php";

class StudentTermDataRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        self::$db = $db;
    }

    // list all the educational institutions in our db
    public function list($student_id): array
    {
        $getStudentQuery = "SELECT * FROM StudentTermData WHERE student_id = ?";
        $ite = self::$db->accessorQuery($getStudentQuery, 's', $student_id);

        $std = new StudentTermData();
        $std = $std->toRefList();
        $studentTermData = [];
        $ite->scan(...$std);
        while($ite->next()) {
            array_push($studentTermData, new StudentTermData($std));
        }

        return $studentTermData;
    }
}

?>
