<?php

class App
{
    private $controller = 'Login';
    private $method = 'index';
    private $params = [];
    private $url;

    public function __construct()
    {
        SessionManager::startSession();
        $this->url = $this->parseUrl();
        $this->processRequest();
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $this->url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    private function processRequest()
    {
        if ($this->requestIsForLoginOrSignUp() or Utility::userIsLoggedIn()) {
            $this->updateController();
            $this->setController();
            $this->updateMethod();
            $this->params = $this->url ? array_values($this->url) : [];
        } else {
            $this->setController();
        }
        $this->addModel();
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function requestIsForLoginOrSignUp()
    {
        return $this->url[0] == 'Login' || $this->url[0] == 'SignUp';
    }

    private function updateController()
    {
        $controller = $this->url[0];
        if (file_exists("../app/controllers/$controller.php")) {
            $this->controller = $this->url[0];
            unset($this->url[0]);
        }
    }

    private function setController()
    {
        require_once("../app/controllers/$this->controller.php");
        $this->controller = new $this->controller();
    }

    private function updateMethod()
    {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
                unset($this->url[1]);
            }
        }
    }

    private function addModel()
    {
        $model = null;

        if (get_class($this->controller) == 'Login') {
            $model = new LoginModel(DbConfig::getInstance());
        } else if (get_class($this->controller) == 'SignUp') {
            $model = new SignUpModel(DbConfig::getInstance());
        }

        if ($model != null) {
            $this->controller->setModel($model);
        }
    }
}
