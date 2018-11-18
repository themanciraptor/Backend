<?php
/**
 * This is the interface for the User Repository. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * @author: Ezra Carter
 */

interface UserInterface {
    public function update(string $userID, array $updateParams): bool;
    public function create(string $email, string $password, string $userID = null): string;
    public function verify(string $email, string $password): string;
    public function get(string $id): User;
}

?>
