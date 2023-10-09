<?php
header("Access-Control-Allow-Origin: *");
include '../service/adminService.php';
class AdminController
{
    private $AdminService;
    public function __construct()
    {
        $this->AdminService = new AdminService();
    }

    public function showAllUsersExeptAdmin()
    {
        echo $this->AdminService->getAllNormalUsers();
    }
    public function deleteUser()
    {
        $username = $_POST["username"];
        $this->AdminService->deleteUser($username);
    }
    public function editUser()
    {
        $this->AdminService->editUser($_POST["oldUserName"], $_POST);
    }
    public function addNewUser()
    {
        $username = $_POST["userName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $isActive = $_POST["isActive"];
        $isAdmin = $_POST["isAdmin"];
        // $repeatPassword = $_POST["repeatPassword"];
        $addNewUser = new AdminService();
        echo $addNewUser->addNewUser($username, $password, $email, $isActive, $isAdmin);
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $admin = new AdminController();
    if (isset($_POST["getUsers"])) {
        $admin->showAllUsersExeptAdmin();
    }
    if (isset($_POST["deleteUser"])) {
        $admin->deleteUser();
    }
    if (isset($_POST["editUser"])) {
        $admin->editUser();
    }
    if (isset($_POST["addUser"])) {
        $admin->addNewUser();
    }
}


?>