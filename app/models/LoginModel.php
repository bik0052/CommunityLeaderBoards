<?php

require_once 'iLoginModel.php';

class LoginModel implements iLoginModel
{
    private $userName;
    private $password;
    private $userNameErr;
    private $passwordErr;
    private $db;
    private $userData;

    public function __construct(iSql $newDb)
    {
        $this->db = $newDb;
    }

    public function logInSuccess()
    {
        $result = false;
        $this->setUserName();
        $this->setPassword();
        $this->validateCredential();
        if (Utility::userIsLoggedIn()) {
            $result = true;
        }
        return $result;
    }

    private function setUserName()
    {
        if (empty(trim($_POST["username"]))) {
            $this->userNameErr = "Please enter username.";
        } else {
            $this->userName = trim($_POST["username"]);
        }
    }

    private function setPassword()
    {
        if (empty(trim($_POST["password"]))) {
            $this->passwordErr = "Please enter your password.";
        } else {
            $this->password = trim($_POST["password"]);
        }
    }

    private function validateCredential()
    {
        if (empty($this->userNameErr) && empty($this->passwordErr)) {
            $this->getStoredCredentials();
            if ($this->passwordIsValid()) {
                $this->setUserDetails();
            }
            unset($this->userData);
        }
    }

    private function getStoredCredentials()
    {
        $this->db->selectDatabase();
        $sql = "select LI.userID, user.firstName, LI.username, LI.password
                from logininfo as LI
                inner join user on LI.userID = user.userID
                where LI.username = '$this->userName';";
        $result = $this->db->query($sql);
        if ($result->size() == 1) {
            $this->userData = $result->fetch();
        } else {
            $this->userNameErr = "No account found with that username.";
        }
        $this->db->close();
    }

    private function passwordIsValid()
    {
        $password = strtolower($this->userName) . $this->password;
        $result = false;
        if (password_verify($password, $this->userData['password'])) {
            $result = true;
        } else {
            $this->passwordErr = "The password you entered was not valid.";
        }
        return $result;
    }

    private function setUserDetails()
    {
        SessionManager::set('loggedin', true);
        SessionManager::set('id', $this->userData['userID']);
        SessionManager::set('firstName', $this->userData['firstName']);
        SessionManager::set('userName', $this->userData['username']);
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __isset($key)
    {
        if (isset($this->$key)) {
            return (false === empty($this->$key));
        } else {
            return null;
        }
    }
}