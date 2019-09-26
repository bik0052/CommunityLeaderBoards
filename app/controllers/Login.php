<?php
require_once 'iLogin.php';

class Login extends Controller implements iLogin
{
    private $model = null;
    private $params = [];
    private $view = 'Login/index';

    public function setModel(iLoginModel $login)
    {
        $this->model = $login;
    }

    public function index()
    {
        if (Utility::userIsLoggedIn()) {
            $this->redirectToHome();
        } else {
            $this->redirectToLogin();
        }
    }

    private function redirectToHome()
    {
        Utility::redirect(Utility::getNewPath('Home/'));
    }

    private function redirectToLogin()
    {
        $this->getView($this->view, $this->params);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->processLogin();
        }
    }

    private function processLogin()
    {
        if ($this->model->logInSuccess()) {
            $this->redirectToHome();
        } else {
            $this->params = ['login' => $this->model];
            $this->redirectToLogin();
        }
    }
}