<?php
class AuthController {
    public static function login() {
        require BASE_PATH . "/app/views/auth/login.php";
    }

    public static function register() {
        require BASE_PATH . "/app/views/auth/register.php";
    }
}

