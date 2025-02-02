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
    public function createEvent($user_id, $name, $description, $event_date, $capacity)
    {
        $id = GuidGenerator::generateGUID();
        $sql = "INSERT INTO events (id, user_id, name, description, event_date, max_capacity) VALUES (:id, :user_id, :name, :description, :event_date, :max_capacity)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $user_id,
            ':name' => $name,
            ':description' => $description,
            ':event_date' => $event_date,
            ':max_capacity' => $capacity
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

    public function getUpcomingThreeEvents()
    {
        $sql = "SELECT events.* FROM events ORDER BY event_date LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get an event by ID
    public function getEventById($id)
    {
        $sql = "SELECT events.*, users.name as user_name FROM events JOIN users ON users.id = events.user_id WHERE events.id = :id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an event
    public function updateEvent($id, $name, $description, $event_date, $capacity)
    {
        $sql = "UPDATE events SET name = :name, description = :description, event_date = :event_date, max_capacity = :max_capacity WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':event_date' => $event_date,
            ':max_capacity' => $capacity
        ]);
    }

    // Delete an event
    public function deleteEvent($id)
    {
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getAllPaginated($page, $perPage, $sortColumn = 'event_date', $sortOrder = 'ASC', $filter = null)
    {
        // Calculate OFFSET for pagination
        $offset = ($page - 1) * $perPage;

        // Base query
        $query = "SELECT * FROM events";
        $params = [];

        // Apply filtering
        if ($filter) {
            $query .= " WHERE event_name LIKE ? OR description LIKE ?";
            $params[] = "%$filter%";
            $params[] = "%$filter%";
        }

        // Apply sorting
        $query .= " ORDER BY $sortColumn $sortOrder LIMIT $perPage OFFSET $offset";

        // Execute query
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCount($filter = null)
    {
        $query = "SELECT COUNT(*) FROM events";
        $params = [];

        if ($filter) {
            $query .= " WHERE event_name LIKE ? OR description LIKE ?";
            $params[] = "%$filter%";
            $params[] = "%$filter%";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}
