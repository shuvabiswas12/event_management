<?php

require_once BASE_PATH . "/config/Database.php";

class Attendee
{
    public static function countByEvent($eventId)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM attendees WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetchColumn();
    }

    public static function register($eventId, $userId)
    {
        $db = Database::connect();

        // Prevent duplicate registration
        $stmt = $db->prepare("SELECT COUNT(*) FROM attendees WHERE event_id = ? AND user_id = ?");
        $stmt->execute([$eventId, $userId]);
        if ($stmt->fetchColumn() > 0) {
            return 409;  // duplicate entry
        }
        // Insert attendee into the database
        $stmt = $db->prepare("INSERT INTO attendees (event_id, user_id) VALUES (?, ?)");
        if ($stmt->execute([$eventId, $userId])) {
            return 201;  // successful
        } else {
            return 500;  // Failed
        }
    }
}
