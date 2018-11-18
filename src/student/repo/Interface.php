<?php
/**
 * This is the interface for the Student repository. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * @author: Ezra Carter
 */
require_once "src/student/model/Student.php";

interface StudentInterface {
    public function get(string $user_id): Student;
    public function create(array $studentData): string;
    public function update(Student $student): bool;
}

?>
