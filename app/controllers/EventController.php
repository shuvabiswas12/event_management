<?php
require_once dirname(__DIR__) . "/models/Event.php";
require_once dirname(__DIR__) . "/models/Attendee.php";

class EventController
{
    public static function index()
    {
        $obj = new Event();
        $events = $obj->getAllEvents();
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

            if (empty($name) || empty($description) || empty($event_date)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: " . ROOT . "/events/create");
                exit();
            }

            $event = new Event();
            if ($event->createEvent($user_id, $name, $description, $event_date)) {
                $_SESSION["success"] = "Event created successfully!";
            } else {
                $_SESSION["error"] = "Failed to create event!";
            }
            header("Location: /event_management/events");
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

            if (empty($name) || empty($description) || empty($event_date)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: " . ROOT . "/events/edit/$id");
                exit();
            }

            $obj = new Event();

            $obj->updateEvent($id, $name, $description, $event_date);
            $_SESSION['success'] = "Event updated successfully!";
            header("Location: " . ROOT . "/events");
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
        header("Location: /event_management/events");
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

            $events = $eventObj->getAllEvents();
            require BASE_PATH . "/app/views/event/register.php";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventId = $_POST["event_id"];
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
            $success = Attendee::register($eventId, $userId);
            if ($success === 201) {
                $_SESSION["success"] = "Registration successful!";
            } else if ($success === 409) {
                $_SESSION["error"] = "You are already registered for this event.";
            } else {
                $_SESSION["error"] = "Failed to register.";
            }

            header("Location: /event_management/events/register");
            exit();
        }
    }
}
