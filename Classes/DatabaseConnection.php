<?php

class DatabaseConnection
{
    protected static $connection = null;

    public static function getConnection()
    {
        if (self::$connection == null) {
            $servername = Configuration::getConfigParameter("servername");
            $username = Configuration::getConfigParameter("username");
            $password = Configuration::getConfigParameter("password");
            $dbname = Configuration::getConfigParameter("dbname");

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            self::$connection = mysqli_connect($servername, $username, $password, $dbname);
        }
        return self::$connection;
    }

    public static function executeMysqlQuery($query)
    {
        try {
            $result = mysqli_query(self::getConnection(), $query);
        } catch (mysqli_sql_exception $exception){
            $error = mysqli_error(self::getConnection());
            throw new mysqli_sql_exception("Error with Query: '".$query."'<br><br>".$error);
        }
        return $result;
    }
}