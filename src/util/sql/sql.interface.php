<?php
/**
 * This is the interface for the sql library. The purpose of this interface is to enable dependency inversion for the whole app.
 * 
 * A repo module should thus require something implementing the SqlInterface, not a specific class
 * 
 * @author: Ezra Carter
 */

 interface SqlInterface {
    function mutatorQuery(string $query, string $typeList, ...$params): bool;
    function accessorQuery(string $query, string $typeList, ...$params): RowIteratorInterface;
 }

 interface RowIteratorInterface {
    function scan(&...$params);
    function next(): bool;
 }
?>