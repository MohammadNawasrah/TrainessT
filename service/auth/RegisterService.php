<?php

header("Access-Control-Allow-Origin: *");
include '../../model/users.php';
include '../../scripts/userDataValidation.php';
include '../../data/database/crud.php';

class RegisterService
{
    private $tableName = "users";
    private $primaryColumnName = "userName";
    private $user;
    private $crud;
    private $repeatPassword;
    public function __construct($userName, $email, $password, $repeatPassword)
    {
        $this->user = new Users($userName, $password);
        $this->user->setEmail($email);
        $this->crud = new Crud();
        $this->setRepeatPassword($repeatPassword);
    }

    public function isUserNameInDb($userNameFromDb)
    {
        if (!isset($userNameFromDb)) {
            return false;
        }
        return true;
    }
    public function checkPasswordS($password, $passwordFromDb)
    {
        if (isset($passwordFromDb)) {
            if ($password != $passwordFromDb) {
                return false;
            }
        }
        return true;
    }
    public function getRepeatPassword()
    {
        return $this->repeatPassword;
    }

    public function setRepeatPassword($repeatPassword)
    {
        $this->repeatPassword = $repeatPassword;
    }
    public function registerNewUser()
    {
        $userNameFromDb = null;
        $userDataFromDb = $this->crud->getDataByColumn($this->tableName, $this->primaryColumnName, $this->user->getUserName());
        if ($userDataFromDb != "") {
            $userNameFromDb = $userDataFromDb["userName"];
        }
        if ($this->isUserNameInDb($userNameFromDb)) {
            return json_encode(["erorr" => "User Name Alerdy exist"]);
        }
        $checkData = $this->user->checkdataUser();
        if (!is_bool($checkData)) {
            return json_encode(["erorr" => $checkData]);
        }
        if (!$this->checkPasswordS($this->user->getPassword(), $this->getRepeatPassword())) {
            return json_encode(["erorr" => "Two password not the sames"]);
        }
        $this->crud->createRecord($this->tableName, ["userName" => $this->user->getUserName(), "email" => $this->user->getEmail(), "password" => md5($this->user->getPassword())]);
        return json_encode(["done" => "success create your acount"]);
    }
}

?>