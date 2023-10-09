<?php

header("Access-Control-Allow-Origin: *");
include '../../model/users.php';
include '../../scripts/userDataValidation.php';
include '../../data/database/crud.php';

class LoginService
{
    private $tableName = "users";
    private $primaryColumnName = "userName";
    private $user;
    private $crud;
    public function __construct($userName, $password)
    {
        $this->user = new Users($userName, $password);
        $this->crud = new Crud();
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
    public function userLogin()
    {
        $passwordFromDb = null;
        $userNameFromDb = null;
        $isActiveFromDb = null;
        $isAdminFromDb = null;
        $userDataFromDb = $this->crud->getDataByColumn($this->tableName, $this->primaryColumnName, $this->user->getUserName());
        if ($userDataFromDb != "") {
            $passwordFromDb = $userDataFromDb["password"];
            $userNameFromDb = $userDataFromDb["userName"];
            $isActiveFromDb = $userDataFromDb["isActive"];
            $isAdminFromDb = $userDataFromDb["isAdmin"];
        }
        if (!$this->isUserNameInDb($userNameFromDb)) {
            return json_encode(["erorr" => "Not found UserName"]);
        }
        $checkData = $this->user->checkdataUser();
        if (!is_bool($checkData)) {
            return json_encode(["erorr" => $checkData]);
        }

        if (!$this->checkPasswordS(md5($this->user->getPassword()), $passwordFromDb)) {
            return json_encode(["erorr" => "Erorr in password"]);
        }
        if (isset($isActiveFromDb)) {
            if (!$isActiveFromDb)
                return json_encode(["notActivate" => "This account is inactive, please wait for the administrator to activate your account"]);
        }
        return json_encode(["done" => $isAdminFromDb ? "adminPanel" : "user"]);
    }
}

?>