<?php
require_once BASE_PATH . "/config/Database.php";
require_once BASE_PATH . "/app/utils/GuidGenerator.php";

class Event
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }


    // Create a new event
    public function createEvent($user_id, $name, $description, $event_date)
    {
        $id = GuidGenerator::generateGUID();
        $sql = "INSERT INTO events (id, user_id, name, description, event_date) VALUES (:id, :user_id, :name, :description, :event_date)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $user_id,
            ':name' => $name,
            ':description' => $description,
            ':event_date' => $event_date
        ]);
    }

    // Get all events
    public function getAllEvents()
    {
        $sql = "SELECT events.*, users.name AS created_by FROM events JOIN users ON events.user_id = users.id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get an event by ID
    public function getEventById($id)
    {
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an event
    public function updateEvent($id, $name, $description, $event_date)
    {
        $sql = "UPDATE events SET name = :name, description = :description, event_date = :event_date WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':event_date' => $event_date
        ]);
    }

    // Delete an event
    public function deleteEvent($id)
    {
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
