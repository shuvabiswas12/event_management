<?php

require_once dirname(__DIR__) . "/models/Attendee.php";

class AttendeeController
{
    public static function viewDetails($event_id, $user_id)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /event_management/auth/login");
            exit();
        }

        $result = null;

        if ($_SESSION['user_id'] === $user_id) {
            $result = Attendee::getAttendeeByEvent($event_id, $user_id);
        }

        require BASE_PATH . "/app/views/attendee/details.php";
    }

    public static function bookingHistory()
    {
        require_once BASE_PATH . "/app/models/Attendee.php";

        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION["error"] = "Please log in to view your booking history.";
            header("Location: /event_management/auth/login");
            exit();
        }

        $bookings = Attendee::getAllBookingsByUser($_SESSION['user_id']);

        require BASE_PATH . "/app/views/attendee/history.php";
    }

    public static function downloadAttendeeReport($event_id)
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION["error"] = "Please log in to view your booking history.";
            header("Location: /event_management/auth/login");
            exit();
        }

        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT a.name AS attendee_name, a.email, a.registration_at, e.name AS event_name, e.event_date
                            FROM attendees a 
                            JOIN events e ON a.event_id = e.id 
                            WHERE a.event_id = :event_id");
        $stmt->execute([':event_id' => $event_id]);
        $attendees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$attendees) {
            $_SESSION["error"] = "No attendees found for this event.";
            header("Location:" . "/event_management/events/view/" . $event_id);
            exit();
        }

        // Set CSV headers
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="event_attendees.csv"');

        // Open file pointer for output
        $output = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($output, ['Attendee Name', 'Email', 'Event Name', 'Event Date', 'Registration Date']);

        // Add attendee data
        foreach ($attendees as $attendee) {
            fputcsv($output, [
                $attendee['attendee_name'],
                $attendee['email'],
                $attendee['event_name'],
                date('Y-m-d', strtotime($attendee['event_date'])),
                date('Y-m-d', strtotime($attendee['registration_at']))
            ]);
        }

        fclose($output);
        exit;
    }
}
