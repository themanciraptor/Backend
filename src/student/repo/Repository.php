<?php
/**
 * Student Repository is for basic data update or access to Student table.
 * 
 * @author: Ezra Carter
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
require_once "src/util/sql/Interface.php";
require_once "src/student/model/Student.php";

class StudentRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        self::$db = $db;
    }

    // get a student by user_id
    public function get(string $user_id): Student
    {
        $getStudentQuery = "SELECT * FROM Student WHERE user_id = ?";
        $ite = self::$db->accessorQuery($getStudentQuery, "s", $user_id);

        $student = new Student;
        $ite->scan(...$student->toRefList());
        $ite->next();

        return $student;
    }

    // create a student
    public function create(array $studentData): string
    {
        /*
            At minimum $studentData must be ["user_id" => "SomeID"]

            $studentData must be a subset of the following array:

            [
                "student_id" => "",
                "user_id" => "",
                "first_name" => "",
                "last_name" => "",
                "email" => "someemail@email.com",
                "address" => "",
            ]

            returns: string of the student_id on success, else an empty string
        */
        $student = new Student($studentData);
    
        $createStudentQuery = sprintf("INSERT INTO Student VALUES (%s)", Sql::getStatementParams(9));
        var_dump($student->toRefList());

        if(self::$db->mutatorQuery($createStudentQuery, "sssssssss", ...$student->toRefList())) {
            return $student->student_id;
        }

        return "";
    }

    // update a student by user_id
    // public function update(string $userID, array $updateParams): bool
    // {
    //     $values = [getSqlNow()];
    //     $columns = "modified = ?";
    //     $typelist = "ss";

    //     // don't want to attempt updating the keys
    //     unset($updateParams['user_id']);
    //     unset($updateParams['student_id']);

    //     foreach ($student as $key => $value) {
    //         $columns .= ", $key = ?";
    //         $typelist .= "s";
    //     }

    //     $updateUserQuery = "UPDATE Student SET %s WHERE user_id = `$userID`";

    //     return self::$db->mutatorQuery($updateUserQuery, $typelist, ...$updateParams);
    // }

}

?>
