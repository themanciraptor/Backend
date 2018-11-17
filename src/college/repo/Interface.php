<?php
/**
 * This is the interface for the Student repository. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * @author: Ezra Carter
 */

interface StudentInterface {
    public function list(): array;
}

?>
