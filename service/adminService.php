<?php

header("Access-Control-Allow-Origin: *");
include '../model/users.php';
include '../scripts/userDataValidation.php';
include '../data/database/crud.php';

class AdminService
{
    // private $user;
    private $tableName = "users";
    private $primaryColumnName = "userName";
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud();
    }

    public function getAllNormalUsers()
    {
        $allUsersEtherAdmin = $this->crud->getAllDataByCondition($this->tableName, "isAdmin", 0);
        if (isset($allUsersEtherAdmin)) {
            return json_encode($allUsersEtherAdmin);
        }

    }
    public function getAllUsers()
    {
        $allUsers = $this->crud->getAllData($this->tableName);
        if (isset($allUsers)) {
            return json_encode($allUsers);
        }

    }
    public function getAllAdmins()
    {
        $allAdmins = $this->crud->getAllDataByCondition($this->tableName, "isAdmin", 1);
        if (isset($allAdmins)) {
            return json_encode($allAdmins);
        }

    }
    public function getUserByUsername($userName)
    {
        $allAdmins = $this->crud->getAllDataByCondition($this->tableName, $this->primaryColumnName, $userName);
        if (isset($allAdmins)) {
            return json_encode($allAdmins);
        }
    }
    public function deleteUser($userName)
    {
        try {
            return $this->crud->delete($this->tableName, $this->primaryColumnName, $userName);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function editUser($userName, $data)
    {
        try {
            $userNameToEdit = $userName;
            if ($lastKey = array_key_last($data)) {
                unset($data[$lastKey]);
            }
            if ($lastKey = array_key_last($data)) {
                unset($data[$lastKey]);
            }
            $this->crud->update($this->tableName, $this->primaryColumnName, $userNameToEdit, ["email" => $data["email"], "password" => md5($data["password"]), "isAdmin" => $data["isAdmin"], "isActive" => $data["isActive"]]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function isUserNameInDb($userNameFromDb)
    {
        if (!isset($userNameFromDb)) {
            return false;
        }
        return true;
    }
    public function addNewUser($username, $password, $email, $isActive, $isAdmin)
    {
        $user = new Users($username, $password);
        $user->setEmail($email);
        $user->setIsActive($isActive);
        $user->setIsAdmin($isAdmin);
        $userNameFromDb = null;
        $userDataFromDb = $this->crud->getDataByColumn($this->tableName, $this->primaryColumnName, $user->getUserName());
        if ($userDataFromDb != "") {
            $userNameFromDb = $userDataFromDb["userName"];
        }
        if ($this->isUserNameInDb($userNameFromDb)) {
            return json_encode(["erorr" => "User Name Alerdy exist"]);
        }
        $checkData = $user->checkdataUser();
        if (!is_bool($checkData)) {
            return json_encode(["erorr" => $checkData]);
        }
        $this->crud->createRecord($this->tableName, ["userName" => $user->getUserName(), "email" => $user->getEmail(), "password" => md5($user->getPassword()), "isActive" => $user->getIsActive(), "isAdmin" => $user->getIsAdmin()]);
        return json_encode(["done" => "success create your acount"]);
    }
}
?>