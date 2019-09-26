<?php

class Home extends Controller
{
    public function index()
    {
        if (Utility::userIsLoggedIn()) {
            $this->getView('Header/index', ['active' => 'Home']);
            $this->getView('Home/index', ['name' => SessionManager::get('firstName')]);
        } else {
            Utility::redirect(Utility::getNewPath('Login/'));
        }
    }
}