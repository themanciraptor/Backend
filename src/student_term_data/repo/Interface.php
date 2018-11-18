<?php
/**
 * This is the interface for the StudentTermData repository. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * @author: Ezra Carter
 */

interface StudentTermDataInterface {
    public function list(string $student_id): array;
    public function create(array $studentTermData): string;
}

?>
