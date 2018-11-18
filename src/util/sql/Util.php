<?php
/* Additional helper functions specifically for code dealing with sql that may not want to import the sql class directly */

// Get the current time in a format that can be submitted to sql
function getSqlNow(): string
{
    return date("Y-m-d H:i:s");
}

class QueryBuilder
{
    private $_query = "";
    private $_statements = [];
    private $_filters = [];

    function __construct(string $query)
    {
        $this->_query = $query;    
    }

    public function addModified(): QueryBuilder
    {
        array_push($this->_statements, new Statement('modified', 's', getSqlNow()));
        return $this;
    }

    public function addStatement(string $key, string $type, $value): QueryBuilder
    {
        array_push($this->_statements, new Statement($key, $type, $value));
        return $this;
    }

    public function addFilter(string $key, string $type, $value): QueryBuilder
    {
        array_push($this->_filters, new Statement($key, $type, $value));
        return $this;
    }

    public function doQuery(closure $queryFunc): bool
    {
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
            $typeList .= $this->_statements[$i]->getType();
            array_push($values, $this->_filters[$i]->getValue());

            $i++; 
        } while($i < count($this->_filters) && $fullFilters .= ', ');

        $query = sprintf($this->_query, $fullStatement, $fullFilters);

        return $queryFunc($query, $typeList, ...$values);
    }
}

class Statement
{
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
