<?php

interface iSql
{
    public function connectToServer();

    public function selectDatabase();

    public function createDatabase();

    public function isError();

    public function close();
}