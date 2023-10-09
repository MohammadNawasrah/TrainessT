<?php
class UserDataValidation
{
    public static function checkLenOfString($userName, $numberOfChar)
    {
        return strlen($userName) >= $numberOfChar;
    }

    public static function isPasswordStrong($password)
    {
        if (!preg_match('/[0-9]/', $password)) {
            return "password must have at least one number";
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return "password must have at least one capital letter character";
        }

        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return "password must have at least one symbol";
        }
        return true;
    }
    public static function isNotEmpty($data)
    {
        return !empty($data);
    }
}