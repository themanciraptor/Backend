<?php
/**
 * This is the interface for the sql library. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * A repo module should thus require something implementing the SqlInterface, not a specific class
 * 
 * @author: Ezra Carter
 */

interface UserInterface {
    public function update(User $user): bool;
    public function create(string $email, string $password, string $userID = null): string;
    public function verify(string $email, string $password): bool;
    public function get(string $id): User;
}

?>
