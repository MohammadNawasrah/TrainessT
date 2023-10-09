<?php
// header("Access-Control-Allow-Origin: *");
include '../../service/auth/loginService.php';
class LoginController
{
    public function login()
    {
        try {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if (UserDataValidation::isNotEmpty($username) == 1) {
                if (UserDataValidation::isNotEmpty($password) == 1) {
                    $tryLogin = new LoginService($username, $password);
                    echo $tryLogin->userLogin();
                }
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $login = new LoginController();
    $login->login();
}