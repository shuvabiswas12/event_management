<?php
// Start session
session_start();

// Define the base directory
define('BASE_PATH', dirname(__DIR__) . '/event_management');

// define the root folder
define('ROOT',  '/event_management');

// Get the requested route (default to 'home' if empty)
$route = isset($_GET['route']) && $_GET['route'] !== '' ? $_GET['route'] : 'home';

// Load the required controller
require_once BASE_PATH . "/app/controllers/AuthController.php";

switch ($route) {
    case 'auth/login':
        AuthController::login();
        break;
    case 'auth/register':
        AuthController::register();
        break;
    case 'home':
        require BASE_PATH . "/app/views/index.php";
        break;
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
}
