<?php
/** 
 * Additional helper functions specifically for code dealing with sql that may not want to import the sql class directly 
 * 
 * @author: Ezra Carter
 */

// Get the current time in a format that can be submitted to sql
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
     *  return $query->doQuery(function($query, $typelist, ...$values): bool {
     *      return self::$db->mutatorQuery($query, $typelist, ...$values
     *  );});
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
         * For models built using my BaseModel, can automatically add modified without any hacksing.
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

    public function doQuery(closure $queryFunc): bool
    {
        /**
         * Do the query via a custom query function. This query function must have the following signature:
         * 
         *   function queryFunc(string $query, string $typeList, ...values)
         */
        $fullStatement = "";
        $typeList = "";
        $values = [];
        
        $i = 0;
        do {
            $fullStatement .= $this->_statements[$i]->toString();
            $typeList .= $this->_statements[$i]->getType();
            array_push($values, $this->_statements[$i]->getValue());

            $i++;
        } while ($i < count($this->_statements) && $fullStatement .= ', ');
        
        $fullFilters = "";
        
        $i = 0;
        do {
            $fullFilters .= $this->_filters[$i]->toString();
            $typeList .= $this->_filters[$i]->getType();
            array_push($values, $this->_filters[$i]->getValue());

            $i++; 
        } while($i < count($this->_filters) && $fullFilters .= ', ');

        $query = sprintf($this->_query, $fullStatement, $fullFilters);

        return $queryFunc($query, $typeList, ...$values);
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
