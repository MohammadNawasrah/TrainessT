<?php
include '../../service/auth/RegisterService.php';
class RegistrationController
{

    public function register()
    {

        try {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeatPassword"];
            $registrationData = new RegisterService($username, $email, $password, $repeatPassword);
            $registrationRespons = $registrationData->registerNewUser();
            echo $registrationRespons;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $newUser = new RegistrationController();
    $newUser->register();
}