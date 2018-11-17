<?php
/**
 * This is the interface for the Student repository. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * @author: Ezra Carter
 */

interface StudentInterface {
    public function update(User $user): bool;
    public function create(string $email, string $password, string $userID = null): string;
    public function get(string $id): User;
}

?>
