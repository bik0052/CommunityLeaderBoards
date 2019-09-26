<?php

require_once 'iResult.php';

class MySqlResult implements iResult
{
    private $mysql;
    private $queryResource;

    public function fetch()
    {
        if ($row = mysqli_fetch_array($this->queryResource, MYSQLI_ASSOC)) {
            return $row;
        } else if ($this->size() > 0) {
            mysqli_data_seek($this->queryResource, 0);
            return false;
        } else {
            return false;
        }
    }

    public function size()
    {
        return mysqli_num_rows($this->queryResource);
    }

    public function insertID()
    {
        return mysqli_insert_id($this->mysql->dbConn);
    }


    public function isError()
    {
        return $this->mysql->isError();
    }

    public function setResource($newMysql, $newQueryResource)
    {
        $this->mysql = $newMysql;
        $this->queryResource = $newQueryResource;
    }
}