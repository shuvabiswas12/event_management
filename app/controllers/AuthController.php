<?php
require_once dirname(__DIR__) . "/models/User.php";

class AuthController
{

    public static function logout()
    {
        session_start();
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session

        // Redirect to login page
        header("Location: /event_management/auth/login");
        exit();
    }

    public static function registerUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];

            // Simple validation
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $_SESSION["error"] = "All fields are required!";
                header("Location: /event_management/auth/register");
                exit();
            }
            if ($password !== $confirmPassword) {
                $_SESSION["error"] = "Passwords do not match!";
                header("Location: /event_management/auth/register");
                exit();
            }

            // Check if user already exists
            $user = new User();
            if ($user->userExists($email)) {
                $_SESSION["error"] = "Email is already taken!";
                header("Location: /event_management/auth/register");
                exit();
            }

            // Register user
            if ($user->register($name, $email, $password)) {
                $_SESSION["success"] = "Registration successful! You can now log in.";
                header("Location: /event_management/auth/register");
                exit();
            } else {
                $_SESSION["error"] = "Registration failed!";
                header("Location: /event_management/auth/register");
                exit();
            }
        }
    }

    public static function loginUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            $user = new User();
            if ($user->login($email, $password)) {
                header("Location: /event_management/home"); // Redirect to home page after login
                exit();
            } else {
                $_SESSION["error"] = "Invalid email or password!";
                header("Location: /event_management/auth/login");
                exit();
            }
        }
    }
}
