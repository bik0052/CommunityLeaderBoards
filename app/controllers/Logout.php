<?php

class Logout extends Controller
{
    public function index()
    {
        SessionManager::clear();
        $this->getView('Login/index');
    }
}