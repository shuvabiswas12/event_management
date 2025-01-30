<?php
require_once BASE_PATH . "/config/Database.php";

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    // Check if a user already exists
    public function userExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]); // Use execute() with array for PDO

        return $stmt->fetch() !== false; // Check if user exists
    }

    // Register a new user
    public function register($name, $email, $password)
    {
        if ($this->userExists($email)) {
            return false; // User already exists
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generate GUID for user ID
        $userId = $this->generateGUID();

        // Insert into database
        $sql = "INSERT INTO users (id, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([$userId, $name, $email, $hashedPassword]); // Correct way to execute in PDO

        return $result ? "Registration successful!" : "Registration failed!";
    }

    // Function to generate GUID
    private function generateGUID()
    {
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
        } else {
            return sprintf(
                '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
                mt_rand(0, 65535),
                mt_rand(0, 65535),
                mt_rand(0, 65535),
                mt_rand(16384, 20479),
                mt_rand(32768, 49151),
                mt_rand(0, 65535),
                mt_rand(0, 65535),
                mt_rand(0, 65535)
            );
        }
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Start session
            session_start();
            $_SESSION['user_id'] = $user['id']; // Store user ID
            $_SESSION['user_name'] = $user['name']; // Store user name
            $_SESSION['user_email'] = $user['email']; // Store user email

            return true; // Login successful
        }

        return false; // Login failed
    }
}
