<?php

class SignUp extends Controller
{
    private $model = null;
    private $params = [];
    private $view = 'signUp/index';

    public function setModel(iSignUpModel $signUp)
    {
        $this->model = $signUp;
    }

    public function index()
    {
        $this->getView($this->view);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model->signUpSuccess()) {
                $this->view = 'login/index';
            } else {
                $this->params = ['signUp' => $this->model];
            }
        }
        $this->getView($this->view, $this->params);
    }
}