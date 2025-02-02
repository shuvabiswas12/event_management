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

        $result = Attendee::getAttendeeByEvent($event_id, $user_id);
        require BASE_PATH . "/app/views/attendee/details.php";
    }
}
