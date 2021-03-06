<?php
/**
 * College Repository is for basic data update or access to College table.
 * 
 * @author: Ezra Carter
 * 
 * Known BUGS: The list function does not return the correct times
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
require_once "src/util/sql/Interface.php";
require_once "src/college/model/College.php";

class CollegeRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        self::$db = $db;
    }

    // list all the educational institutions in our db
    public function list(): array
    {
        $ite = self::$db->accessorQuery("SELECT * FROM College", '');

        $colleges = [];
        do {
            $college = new College();
            $ite->scan(...$college->toRefList());
        } while ($ite->next() && array_push($colleges, $college));

        return $colleges;
    }
}

?>
