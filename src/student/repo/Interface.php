<?php
/**
 * This is the interface for the sql library. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * A repo module should thus require something implementing the SqlInterface, not a specific class
 * 
 * @author: Ezra Carter
 */

interface StudentInterface {
    public function update(User $user): bool;
    public function create(string $email, string $password, string $userID = null): string;
    public function verify(string $email, string $password): string;
    public function get(string $id): User;
}

?>
