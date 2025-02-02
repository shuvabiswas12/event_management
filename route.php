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
require_once BASE_PATH . "/app/controllers/EventController.php";
require_once BASE_PATH . "/app/controllers/HomeController.php";
require_once BASE_PATH . "/app/controllers/AttendeeController.php";

switch (true) {
    case $route === 'auth/login':
        AuthController::loginUser();
        require BASE_PATH . "/app/views/auth/login.php";
        break;
    case $route === 'auth/logout':
        AuthController::logout();
        require BASE_PATH . "/app/views/auth/login.php";
        break;
    case $route === 'auth/register':
        AuthController::registerUser();
        require BASE_PATH . "/app/views/auth/register.php";
        break;
    case $route === 'events':
        EventController::index();
        break;
    case $route === 'events/dashboard':
        EventController::showDashboard();
        break;
    case $route === 'events/create':
        EventController::create();
        require BASE_PATH . "/app/views/event/create.php";
        break;
    case $route === "events/update":
        EventController::update();
        break;
    case $route === "events/register":
        EventController::registerAttendee();
        break;
    case (preg_match("/^events\/view\/(.+)$/", $route, $matches) ? true : false):
        EventController::view($matches[1]);
        break;
    case (preg_match("/^events\/edit\/(.+)$/", $route, $matches) ? true : false):
        EventController::edit($matches[1]);
        break;
    case preg_match("/^events\/delete\/(.+)$/", $route, $matches):
        EventController::delete($matches[1]);
        break;
    case preg_match("/^attendees\/details\/(.+)\/(.+)$/", $route, $matches):
        AttendeeController::viewDetails((string)$matches[1], (string)$matches[2]);
        break;
    case $route === 'home':
        HomeController::index();
        break;
    default:
        http_response_code(404);
        require BASE_PATH . "/app/views/404.php";
        break;
}
