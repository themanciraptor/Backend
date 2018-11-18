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

        if(self::$db->mutatorQuery($createStudentQuery, "sssssssss", ...$student->toRefList())) {
            return $student->student_id;
        }

        return "";
    }

    // update a student by user_id
    public function update(Student $student): bool
    {
        $query = (new QueryBuilder("UPDATE Student SET %s WHERE %s"))
            ->addFilter("user_id", "s", $student->user_id)
            ->addModified();

        $vars = get_object_vars($student);
        foreach ($vars as $key => $value) {
            $query->addStatement($key, "s", $value);
        }

        return $query->doQuery(function($query, $typelist, ...$values): bool {
            return self::$db->mutatorQuery($query, $typelist, ...$values
        );});
    }
}

?>
