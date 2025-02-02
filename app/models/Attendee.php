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

    public static function register($eventId, $userId, $name, $email)
    {
        $db = Database::connect();

        // Prevent duplicate registration
        $stmt = $db->prepare("SELECT COUNT(*) FROM attendees WHERE event_id = ? AND user_id = ?");
        $stmt->execute([$eventId, $userId]);
        if ($stmt->fetchColumn() > 0) {
            return 409;  // duplicate entry
        }
        // Insert attendee into the database
        $stmt = $db->prepare("INSERT INTO attendees (event_id, user_id, name, email) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$eventId, $userId, $name, $email])) {
            return 201;  // successful
        } else {
            return 500;  // Failed
        }
    }

    public static function getAttendeeByEvent($eventId, $userId)
    {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT a.name AS attendee_name, a.email, e.name AS event_name, e.event_date 
                                FROM attendees a 
                                JOIN events e ON a.event_id = e.id 
                                WHERE a.event_id = :event_id AND a.user_id = :user_id");
        $stmt->execute([':event_id' => (string)$eventId, ':user_id' => (string)$userId]);
        $attendee = $stmt->fetch(PDO::FETCH_ASSOC);
        return $attendee;
    }

    public static function getAllBookingsByUser($user_id)
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("
        SELECT a.event_id, a.user_id, e.name AS event_name, e.event_date, a.registration_at as registration_date
        FROM attendees a 
        JOIN events e ON a.event_id = e.id 
        WHERE a.user_id = :user_id
        ORDER BY e.event_date DESC
    ");

        $stmt->execute([':user_id' => $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
