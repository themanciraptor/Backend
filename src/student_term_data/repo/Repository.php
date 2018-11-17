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

        $studentTermData = [];        
        for ($std = new StudentTermData(), $ite->scan(... $std->toRefList());
            $ite->next();
            $std = new StudentTermData(), $ite->scan(... $std->toRefList())) {
                array_push($studentTermData, $std);
        }

        return $studentTermData;
    }

        // create a StudentTermData
        public function create(array $studentTermData): string
        {
            /*
                $studentData must be a subset of the following array:
    
                [
                    "student_term_data_id" => "",
                    "college_id" => "", // Note: this must match an existing row in the College table
                    "student_id" => "", // Note: this must match an existing row in the Student table
                    "enrollment_status" => "",
                    "term" => "",
                ]
    
                returns: string of the student_term_data_id on success, else an empty string
            */
            $std = new StudentTermData($studentTermData);
        
            $createStudentQuery = sprintf("INSERT INTO StudentTermData VALUES (%s)", Sql::getStatementParams(8));
    
            if(self::$db->mutatorQuery($createStudentQuery, "ssssssss", ...$std->toRefList())) {
                return $std->student_id;
            }
    
            return "";
        }
}

?>
