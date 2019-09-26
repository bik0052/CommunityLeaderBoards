<?php
require_once 'iSignUpModel.php';
class SignUpModel implements iSignUpModel
{
    private $firstName;
    private $lastName;
    private $email;
    private $gender;
    private $country;
    private $username;
    private $password;
    private $confirmPassword;
    private $firstNameErr;
    private $lastNameErr;
    private $emailErr;
    private $countryErr;
    private $usernameErr;
    private $passwordErr;
    private $confirmPasswordErr;
    private $signUpSuccessful;
    private $db;

    public function __construct(iSql $db)
    {
        $this->signUpSuccessful = false;
        $this->db = $db;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->initialise();
        }
    }

    private function setFirstName()
    {
        if ($this->IsNotEmpty('firstName')) {
            $this->firstName = Security::sanitise(trim($_POST['firstName']));
        } else {
            $this->firstNameErr = 'Please enter a First Name.';
        }
    }

    private function IsNotEmpty($field)
    {
        return !empty(trim($_POST[$field]));
    }

    private function setLastName()
    {
        if ($this->IsNotEmpty('lastName')) {
            $this->lastName = Security::sanitise(trim($_POST['lastName']));
        } else {
            $this->lastNameErr = 'Please enter a Last Name.';
        }
    }

    private function setEmail()
    {
        if ($this->IsNotEmpty('email') && $this->IsAValidEmail($_POST['email'])) {
            $this->email = Security::sanitise(trim($_POST['email']));
        } else {
            $this->emailErr = 'Please enter a valid email address.';
        }
    }

    private function IsAValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function setGender()
    {
        $this->gender = $_POST['gender'];
    }

    private function setCountry()
    {
        if ($this->IsNotEmpty('country')) {
            $this->country = trim($_POST['country']);
        } else {
            $this->countryErr = 'Please enter a Country name.';
        }
    }

    private function setUsername()
    {
        if ($this->lengthIsNotValid(trim($_POST['username']))) {
            $this->usernameErr = 'The Username must be at least 6 character';
        } else if ($this->usernameExists(trim($_POST['username']))) {
            $this->usernameErr = 'This username is already taken.';
        }

        $this->username = trim($_POST['username']);
    }

    private function lengthIsNotValid($aString)
    {
        return strlen($aString) < 6;
    }

    private function usernameExists($username)
    {
        $sql = "SELECT userID FROM logininfo WHERE username = '$username'";
        $this->db->selectDatabase();
        $result = $this->db->query($sql);
        return $result->size() >= 1;
    }

    private function setPassword()
    {
        if ($this->lengthIsNotValid(trim($_POST['password']))) {
            $this->passwordErr = "Password must have at least 6 characters.";
        } else {
            $this->password = trim($_POST["password"]);
        }
    }

    private function setConfirmPassword()
    {
        $this->confirmPassword = trim($_POST["confirmPassword"]);
        if (empty($this->passwordErr) && ($this->password != $this->confirmPassword)) {
            $this->confirmPasswordErr = "Password did not match.";
        }
    }

    public function signUpSuccess()
    {
        if ($this->noErrors()) {
            $this->registerUser();
        }
        return $this->signUpSuccessful;
    }

    private function noErrors()
    {
        return empty($this->firstNameErr) &&
            empty($this->lastNameErr) &&
            empty($this->emailErr) &&
            empty($this->countryErr) &&
            empty($this->usernameErr) &&
            empty($this->passwordErr) &&
            empty($this->confirmPasswordErr);
    }

    private function registerUser()
    {
        $this->db->selectDatabase();
        $affectedRow = $this->insertUserDetails();
        $this->insertLoginInfo($affectedRow->insertID());
        $this->db->close();
        $this->signUpSuccessful = true;
    }

    private function insertUserDetails()
    {
        $sql = "insert into user value (null,'$this->firstName', '$this->lastName','$this->email','$this->gender','$this->country')";
        return $this->db->query($sql);
    }

    private function insertLoginInfo($userID)
    {
        $hashedPassword = password_hash($this->username . $this->password, PASSWORD_DEFAULT);
        $sql = "insert into logininfo value ($userID,'$this->username', '$hashedPassword')";
        $this->db->query($sql);
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($key)
    {
        if (isset($this->$key)) {
            return (false === empty($this->$key));
        } else {
            return null;
        }
    }

    private function initialise(): void
    {
        $this->setFirstName();
        $this->setlastName();
        $this->setEmail();
        $this->setGender();
        $this->setCountry();
        $this->setUsername();
        $this->setPassword();
        $this->setConfirmPassword();
    }
}