<?php
require_once dirname(__DIR__) . "/models/Event.php";
require_once dirname(__DIR__) . "/models/Attendee.php";

class EventController
{
    public static function index($sort = 'event_date', $order = 'asc', $page = 1)
    {
        $limit = 6; // Number of events per page
        $offset = ($page - 1) * $limit;

        // Ensure only valid sorting columns
        $allowedSortColumns = ['name', 'event_date'];
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'event_date';
        }

        // Ensure order is only 'asc' or 'desc'
        $order = ($order === 'desc') ? 'desc' : 'asc';


        $obj = new Event();
        $events = $obj->getAllEvents($sort, $order, $limit, $offset);
        $totalEvents = $obj->getTotalCount();
        $totalPages = ceil($totalEvents / $limit);

        require BASE_PATH . "/app/views/event/events.php";
    }

    public static function create()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /event_management/auth/login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"]);
            $description = trim($_POST["description"]);
            $user_id = $_SESSION["user_id"];
            $event_date = $_POST["event_date"];
            $max_capacity = $_POST["max_capacity"];

            if (empty($name) || empty($description) || empty($event_date)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: " . ROOT . "/events/create");
                exit();
            }

            $event = new Event();
            if ($event->createEvent($user_id, $name, $description, $event_date, $max_capacity)) {
                $_SESSION["success"] = "Event created successfully!";
            } else {
                $_SESSION["error"] = "Failed to create event!";
            }
            header("Location: /event_management/events/dashboard");
            exit();
        }
    }

    // Get the data into the form field
    public static function edit($id)
    {
        $obj = new Event();
        $event = $obj->getEventById($id);
        if (!$event) {
            error_log("Event not found for ID: " . $id);
            $_SESSION['error'] = "Event not found!";
            header("Location: " . ROOT . "/events");
            exit();
        }
        require BASE_PATH . "/app/views/event/edit.php";
    }

    public static function update()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /event_management/auth/login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $name = trim($_POST["name"]);
            $description = trim($_POST["description"]);
            $event_date = trim($_POST["event_date"]);
            $max_capacity = trim($_POST["max_capacity"]);

            if (empty($name) || empty($description) || empty($event_date) || empty($max_capacity)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: " . ROOT . "/events/edit/$id");
                exit();
            }

            $obj = new Event();

            $obj->updateEvent($id, $name, $description, $event_date, $max_capacity);
            $_SESSION['success'] = "Event updated successfully!";
            header("Location: " . ROOT . "/events/view/" . $id);
            exit();
        }
    }

    public static function delete($id)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /event_management/auth/login");
            exit();
        }

        $event = new Event();
        if ($event->deleteEvent($id)) {
            $_SESSION["success"] = "Event deleted successfully!";
        } else {
            $_SESSION["error"] = "Failed to delete event!";
        }
        header("Location: /event_management/events/dashboard");
        exit();
    }


    public static function registerAttendee()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /event_management/auth/login");
            exit();
        }

        $eventObj = new Event();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            $events = $eventObj->getAllEvents('event_date', 'asc', 999999, "");
            require BASE_PATH . "/app/views/event/register.php";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventId = $_POST["event_id"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $userId = $_SESSION["user_id"];

            // 1️⃣ Check if event exists and get max capacity
            $event = $eventObj->getEventById($eventId);
            if (!$event) {
                $_SESSION["error"] = "Event not found.";
                exit();
            }

            // 2️⃣ Check current attendee count
            $currentAttendees = Attendee::countByEvent($eventId);
            if ($currentAttendees >= $event["max_capacity"]) {
                $_SESSION["error"] = "Sorry, this event is full.";
            }

            // 3️⃣ Register user for the event
            $success = Attendee::register($eventId, $userId, $name, $email);
            if ($success === 201) {
                $_SESSION["success"] = "Registration successful!";
                header("Location: /event_management/attendees/details/$eventId/$userId");
                exit();
            } else if ($success === 409) {
                $_SESSION["error"] = "You are already registered for this event.";
            } else {
                $_SESSION["error"] = "Failed to register.";
            }

            header("Location: /event_management/events/register");
            exit();
        }
    }


    public static function showDashboard()
    {

        // Get query parameters for pagination, sorting, and filtering
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'event_date';
        $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        $filter = isset($_GET['filter']) ? $_GET['filter'] : null;

        $eventObj = new Event();
        $events = $eventObj->getAllPaginated($page, $perPage, $sortColumn, $sortOrder, $filter);
        $totalEvents = $eventObj->getTotalCount($filter);
        $totalPages = ceil($totalEvents / $perPage);

        // Load the view
        require BASE_PATH . "/app/views/event/dashboard.php";
    }

    public static function view($event_id)
    {
        $eventObj = new Event();
        $event = $eventObj->getEventById($event_id);

        if (!$event) {
            $_SESSION['error'] = "Event not found!";
            header("Location: " . ROOT . "/events/dashboard");
            exit();
        }

        require_once BASE_PATH . "/app/views/event/details.php";
    }

    public static function searchEvents()
    {
        if (!isset($_GET['query']) || empty($_GET['query'])) {
            header("Location: " . ROOT . "/events");
            exit;
        }

        $query = trim($_GET['query']);
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM events WHERE name LIKE :query OR description LIKE :query");
        $stmt->execute([':query' => "%$query%"]);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include BASE_PATH . "/app/views/event/events.php";
    }
}
