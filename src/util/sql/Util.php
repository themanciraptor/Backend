<?php
/** 
 * Additional helper functions specifically for code dealing with sql that may not want to import the sql class directly 
 * 
 * @author: Ezra Carter
 */

// Get the current time in a format that can be submitted to sql
require_once "src/util/sql/BaseSQL.php";

function getSqlNow(): string
{
    return date("Y-m-d H:i:s");
}

class QueryBuilder
{
    /**
     * QueryBuilder is a helper class based on the builder pattern. It helps to build more secure, and more robust 
     * backend code. was not designed with Select queries in mind. Only "SELECT * WHERE...", Update, and delete queries
     * are guaranteed to work. all filters and statements use "=" to keep things simple. This is only a minor limitation.
     * And one that can be worked around using customer filters and statements.
     * 
     * Usage:
     *  $query = new QueryBuilder("SELECT * FROM %s").addFilter('column_name', "s", "equals this");
     *  return $query->doMutatorQuery($db);
     * 
     * Future work: Move db into Querybuilder so it no longer relies on the user implementing/using existing Sql lib.
     * Plus callback is redundant at the moment.
     * 
     */
    private $_query = "";
    private $_statements = [];
    private $_filters = [];

    function __construct(string $query)
    {
        $this->_query = $query;    
    }

    public function addModified(): QueryBuilder
    {
        /**
         * For models built using BaseModel, can automatically add modified without any hacksing.
         * 
         * TODO: This probably is the wrong place for this.
         */
        array_push($this->_statements, new Statement('modified', 's', getSqlNow()));
        return $this;
    }

    public function addStatement(string $key, string $type, $value): QueryBuilder
    {
        /**
         * Add a statement. These Sql clauses are added to the query first.
         * 
         * returns: The builder instance so we can chain multiple adds.
         */
        array_push($this->_statements, new Statement($key, $type, $value));
        return $this;
    }

    public function addFilter(string $key, string $type, $value): QueryBuilder
    {
        /**
         * Add a statement. These Sql clauses are added to the query first.
         * 
         * returns: The builder instance so we can chain multiple adds.
         */
        array_push($this->_filters, new Statement($key, $type, $value));
        return $this;
    }

    public function doMutatorQuery(SqlInterface $db): bool
    {
        /**
         * Perform a mutator query 
         */
        function processClauses(array $clauseList, string &$typeList, array &$values): string {
            $joinedClauses = "";
            $i = 0;
            do {
                $joinedClauses .= $clauseList[$i]->toString();
                $typeList .= $clauseList[$i]->getType();
                array_push($values, $clauseList[$i]->getValue());
    
                $i++;
            } while ($i < count($clauseList) && $joinedClauses .= ', ');

            return $joinedClauses;
        }

        $typeList = "";
        $values = [];

        $fullStatement = processClauses($this->_statements, $typeList, $values);
        $fullFilters = processClauses($this->_filters, $typeList, $values);

        $query = sprintf($this->_query, $fullStatement, $fullFilters);

        return $db->mutatorQuery($query, $typeList, ...$values);
    }
}

class Statement
{
    /**
     * Statement represents a single SQL clause
     */
    private $_key = "";
    private $_type = "";
    private $_value = null;

    function __construct(string $key, string $type, $value)
    {
        $this->_key = $key;
        $this->_type = $type;
        $this->_value = $value;
    }

    public function toString(): string
    {
        $t = $this->_key;
        return "$t = ?";
    }

    public function getType(): string
    {
        return $this->_type;
    }

    public function getValue()
    {
        return $this->_value;
    }
}
?>
