<?php
require_once 'iSql.php';
require_once 'iQuery.php';

class MySqlDb implements iSql, iQuery
{
    private $host;
    private $dbUser;
    private $dbPass;
    private $dbName;
    private $dbConn;
    private $dbConnectError;
    private $logger;
    private $result;

    public function __construct($host, $dbUser, $dbPass, $dbName,iResult $myResult, iLogger $logger)
    {
        $this->host = $host;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
        $this->result = $myResult;
        $this->logger = $logger;
        $this->connectToServer();
    }

    public function connectToServer()
    {
        $this->dbConn = mysqli_connect($this->host, $this->dbUser, $this->dbPass);
        if (!$this->dbConn) {
            $this->logger->log('could not connect to server');
            $this->dbConnectError = true;
        } else {
            $this->logger->log("connected to server");
        }
    }

    public function selectDatabase()
    {
        if (!mysqli_select_db($this->dbConn, $this->dbName)) {
            $this->logger->log('could not select database');
            $this->dbConnectError = true;
        } else {
            $this->logger->log("$this->dbName database selected");
        }
    }

    public function createDatabase()
    {
        $sql = "create database if not exists $this->dbName";
        $this->logger->log($sql);
        if ( $this->query($sql) )
        {
            $this->logger->log("the $this->dbName database was created");
        }
        else
        {
            $this->logger->log("the $this->dbName database was not created");
        }
    }

    public function isError()
    {
        if  ( $this->dbConnectError )
        {
            return true;
        }
        $error = mysqli_error ( $this->dbConn );
        if ( empty ($error) )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function query($sql)
    {
        if ( ! $queryResource = mysqli_query( $this->dbConn, $sql ) )
        {
            $this->logger->log( 'Query Failed: ' . mysqli_error($this->dbConn ) . ' SQL: ' . $sql );
            return false;
        }
        $this->result->setResource($this, $queryResource );
        return $this->result;
    }

    public function close()
    {
        mysqli_close($this->dbConn);
    }

    public function databaseDoesNotExists()
    {
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->dbName';";
        $result = $this->query($sql);
        return $result->size() < 1;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}