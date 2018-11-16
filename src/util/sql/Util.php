<?php
/* Additional helper functions specifically for code dealing with sql that may not want to import the sql class directly */

// Get the current time in a format that can be submitted to sql
function getSqlNow(): string
{
    return date("Y-m-d H:i:s");
}
?>
