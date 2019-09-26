<?php

class Security
{
    public static function sanitise($input)
    {
        $string = Security::filterSqlInjection($input);
        $string = Security::filterXSS($input);
        return $string;
    }

    private static function filterSqlInjection($input)
    {
        $sqlConnection = DbConfig::getInstance();
        return mysqli_real_escape_string($sqlConnection->dbConn, $input);
    }

    private static function filterXss($input)
    {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES);
    }

}