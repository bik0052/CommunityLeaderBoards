<?php

Abstract Class A{

    public function __construct()
    {
        echo 'hello ' . $this::test;
    }
}

Class B extends A{
    const test = 'World';
}


$a = new B();