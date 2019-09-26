<?php

interface iResult
{
    public function size();

    public function fetch();

    public function insertID();

    public function isError();
}