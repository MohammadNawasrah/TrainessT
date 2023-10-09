<?php
class Users
{
    private $userName;
    private $email;
    private $password;
    private $isActive;
    private $isAdmin;


    public function __construct($userName, $password)
    {
        $this->setUserName($userName);
        $this->setPassword($password);
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function checkdataUser()
    {
        $userName = $this->getUserName();
        $password = $this->getPassword();
        if (!UserDataValidation::checkLenOfString($userName, 8)) {
            return "username is too short";
        }
        if (!UserDataValidation::checkLenOfString($password, 8)) {
            return "password is too short";
        }
        $isStrongPassword = UserDataValidation::isPasswordStrong($password);
        if (!is_bool($isStrongPassword)) {
            return $isStrongPassword;
        }
        return true;
    }
}