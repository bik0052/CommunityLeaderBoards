<?php

class DbConfig
{
    public static function getInstance()
    {
        $host = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'community';
        $logger = new TextLogger();
        $logger->filePath = '../app/Database/log.txt';;
        return new MySqlDb($host, $dbUser, $dbPass, $dbName, new MySqlResult(), $logger);
    }
}